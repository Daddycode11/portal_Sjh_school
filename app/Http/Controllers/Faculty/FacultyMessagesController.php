<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacultyMessagesController extends Controller
{
    /**
     * Display messages dashboard for faculty
     */
    public function index()
    {
        $user = Auth::user();

        // Get all students taught by this faculty
        $students = DB::table('section_subject')
            ->where('faculty_id', $user->id)
            ->join('section_student', function ($join) {
                $join->on('section_subject.section_id', '=', 'section_student.section_id')
                     ->on('section_subject.school_year', '=', 'section_student.school_year')
                     ->on('section_subject.semester', '=', 'section_student.semester');
            })
            ->join('users as students', 'section_student.student_id', '=', 'students.id')
            ->join('sections', 'section_subject.section_id', '=', 'sections.id')
            ->join('subjects', 'section_subject.subject_id', '=', 'subjects.id')
            ->select(
                'students.id as student_id',
                'students.name as student_name',
                'sections.name as section_name',
                'subjects.name as subject_name',
                'subjects.code as subject_code'
            )
            ->distinct()
            ->get();

        // Get recent conversations
        $conversations = DB::table('messages')
            ->where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique(function ($message) use ($user) {
                return $message->sender_id == $user->id ? $message->receiver_id : $message->sender_id;
            })
            ->take(10);

        $conversationUsers = collect();

        foreach ($conversations as $conversation) {
            $otherId = $conversation->sender_id == $user->id
                ? $conversation->receiver_id
                : $conversation->sender_id;

            $otherUser = DB::table('users')
                ->where('id', $otherId)
                ->first();

            if ($otherUser) {
                $conversationUsers->push($otherUser);
            }
        }

        // Count unread messages
        $unreadCount = DB::table('messages')
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();

        // Mark messages as read when viewing the dashboard
        DB::table('messages')
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'updated_at' => now(),
            ]);

        return view('faculty.messages.index', compact('students', 'conversationUsers', 'unreadCount'));
    }

    /**
     * Get conversation with a specific student
     */
    public function getConversation($userId)
    {
        $user = Auth::user();

        // Validate if student belongs to this faculty's section(s)
        $isStudent = DB::table('section_subject')
            ->where('faculty_id', $user->id)
            ->join('section_student', function ($join) {
                $join->on('section_subject.section_id', '=', 'section_student.section_id')
                     ->on('section_subject.school_year', '=', 'section_student.school_year')
                     ->on('section_subject.semester', '=', 'section_student.semester');
            })
            ->where('section_student.student_id', $userId)
            ->exists();

        if (!$isStudent) {
            return response()->json([
                'error' => 'You can only view messages from your students'
            ], 403);
        }

        // Get all messages between faculty and this student
        $messages = DB::table('messages')
            ->where(function ($query) use ($user, $userId) {
                $query->where('sender_id', $user->id)
                      ->where('receiver_id', $userId);
            })
            ->orWhere(function ($query) use ($user, $userId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', $user->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Fetch student user info
        $otherUser = DB::table('users')
            ->where('id', $userId)
            ->first();

        // Fetch subjects shared between faculty and student
        $enrolledSubjects = DB::table('section_subject')
            ->where('faculty_id', $user->id)
            ->join('section_student', function ($join) use ($userId) {
                $join->on('section_subject.section_id', '=', 'section_student.section_id')
                     ->on('section_subject.school_year', '=', 'section_student.school_year')
                     ->on('section_subject.semester', '=', 'section_student.semester')
                     ->where('section_student.student_id', '=', $userId);
            })
            ->join('subjects', 'section_subject.subject_id', '=', 'subjects.id')
            ->select(
                'subjects.name as subject_name',
                'subjects.code as subject_code',
                'section_subject.school_year',
                'section_subject.semester'
            )
            ->get();

        // Mark messages as read when opened
        DB::table('messages')
            ->where('sender_id', $userId)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'updated_at' => now(),
            ]);

        return response()->json([
            'messages' => $messages,
            'user' => $otherUser,
            'enrolledSubjects' => $enrolledSubjects
        ]);
    }

    /**
     * Send a message
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000'
        ]);

        $user = Auth::user();

        // Check if faculty teaches this student
        $isTeaching = DB::table('section_subject')
            ->where('faculty_id', $user->id)
            ->join('section_student', function ($join) use ($request) {
                $join->on('section_subject.section_id', '=', 'section_student.section_id')
                     ->on('section_subject.school_year', '=', 'section_student.school_year')
                     ->on('section_subject.semester', '=', 'section_student.semester')
                     ->where('section_student.student_id', '=', $request->receiver_id);
            })
            ->exists();

        if (!$isTeaching) {
            return response()->json([
                'error' => 'You can only send messages to your students'
            ], 403);
        }

        // Save the message with content ✅
        $messageId = DB::table('messages')->insertGetId([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
           /*  'content' => $request->content, // ✅ Added content */
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $message = DB::table('messages')
            ->where('id', $messageId)
            ->first();

        return response()->json([
            'message' => $message,
            'success' => true
        ]);
    }

    /**
     * Check for new messages
     */
    public function checkNewMessages()
    {
        $user = Auth::user();

        $newMessagesCount = DB::table('messages')
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'count' => $newMessagesCount
        ]);
    }
}

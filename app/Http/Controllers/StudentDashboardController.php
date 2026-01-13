<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Message;
use Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $studentId = Auth::id();

        // Upcoming Assessments (next 3 days)
        $upcomingAssessments = Assessment::whereNotNull('schedule_date')
            ->whereBetween('schedule_date', [now(), now()->addDays(3)])
            ->whereExists(function ($q) use ($studentId) {
                $q->selectRaw('1')
                    ->from('section_subject')
                    ->join('section_student', function ($join) use ($studentId) {
                        $join->on('section_subject.section_id', '=', 'section_student.section_id')
                             ->where('section_student.student_id', $studentId);
                    })
                    ->whereColumn('section_subject.subject_id', 'assessments.subject_id')
                    ->whereColumn('section_subject.school_year', 'assessments.school_year')
                    ->whereColumn('section_subject.semester', 'assessments.semester');
            })
            ->with('subject')
            ->orderBy('schedule_date')
            ->limit(3)
            ->get();

        // Upcoming assessments count
        $upcomingCount = $upcomingAssessments->count();

        // Unread Messages
        $unreadMessagesCount = Message::where('receiver_id', $studentId)
            ->where('is_read', false)
            ->count();

        // Latest 3 messages
        $recentMessages = Message::where('receiver_id', $studentId)
            ->with('sender') // assumes you have sender() relationship in Message model
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();


        // back logs
         $recentAssessments = Assessment::upcomingForStudent(Auth::id())->take(3)->get();



         $unreadMessages = Message::unreadFor(Auth::id())->count();

        return view('client.dashboard', compact(
            'upcomingAssessments',
            'upcomingCount',
            'unreadMessagesCount',
            'recentMessages',
            'recentAssessments',
            'unreadMessages'
        ));
    }
}

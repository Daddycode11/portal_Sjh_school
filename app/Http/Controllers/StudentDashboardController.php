<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Enrollment;
use App\Models\Assessment;
use App\Models\Message;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $studentId = Auth::id(); // Default auth

        // Total Subjects (unique subjects the student is enrolled in)
        $totalSubjects = Enrollment::where('student_id', $studentId)
            ->distinct('subject_id')
            ->count('subject_id');

        // Total Sections (unique sections the student is enrolled in)
        $totalSections = Enrollment::where('student_id', $studentId)
            ->distinct('section_id')
            ->count('section_id');

        // Unread Messages (assuming messages have 'recipient_id' and 'read' column)
        $unreadMessages = Message::where('recipient_id', $studentId)
            ->where('read', false)
            ->count();

        // Upcoming Assessments (future assessments for the student)
        $upcomingAssessments = Assessment::whereHas('section.enrollments', function($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->whereDate('schedule_date', '>=', now())
            ->orderBy('schedule_date', 'asc')
            ->get() ?? collect(); // Ensure it's always a collection

        // Enrollments with related subject, section, and faculty
        $enrollments = Enrollment::with(['subject', 'section', 'faculty'])
            ->where('student_id', $studentId)
            ->get() ?? collect();

        // Recent scores (grades) for this student
        $recentScores = Grade::where('student_id', $studentId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get() ?? collect();

        // Announcements for students or both audiences
        $announcements = Announcement::whereIn('target_audience', ['students', 'both'])
            ->orderBy('posted_at', 'desc')
            ->get() ?? collect();

        // Return view with all variables
        return view('client.dashboard', [
            'totalSubjects' => $totalSubjects ?? 0,
            'totalSections' => $totalSections ?? 0,
            'unreadMessages' => $unreadMessages ?? 0,
            'upcomingAssessments' => $upcomingAssessments,
            'enrollments' => $enrollments,
            'recentScores' => $recentScores,
            'announcements' => $announcements,
        ]);
    }
}

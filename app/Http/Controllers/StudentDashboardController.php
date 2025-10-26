<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Enrollment;
use App\Models\Assessment;
use App\Models\Grade;
use App\Models\Subject;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $studentId = auth()->id(); // Get current logged-in student ID

        // Fetch announcements targeted to students or both
        $announcements = Announcement::whereIn('target_audience', ['students', 'both'])
            ->orderBy('posted_at', 'desc')
            ->get();

        // Total subjects student is enrolled in
        $totalSubjects = Enrollment::where('student_id', $studentId)
            ->distinct('subject_id')
            ->count('subject_id');

        // Total sections student is enrolled in
        $totalSections = Enrollment::where('student_id', $studentId)
            ->distinct('section_id')
            ->count('section_id');

        // Unread messages (set 0 for now, or link to messages system)
        $unreadMessages = 0;

        // Upcoming assessments
        $upcomingAssessments = Assessment::where('schedule_date', '>=', now())
            ->whereHas('enrollments', function($q) use ($studentId) {
                $q->where('student_id', $studentId);
            })
            ->orderBy('schedule_date', 'asc')
            ->get();

        // Enrollments (classes) of the student
        $enrollments = Enrollment::where('student_id', $studentId)
            ->with('subject', 'section', 'faculty')
            ->get();

        // Recent scores (latest 5)
        $recentScores = Grade::where('student_id', $studentId)
            ->latest()
            ->take(5)
            ->get();

        return view('client.dashboard', compact(
            'announcements',
            'totalSubjects',
            'totalSections',
            'unreadMessages',
            'upcomingAssessments',
            'enrollments',
            'recentScores'
        ));
    }
}


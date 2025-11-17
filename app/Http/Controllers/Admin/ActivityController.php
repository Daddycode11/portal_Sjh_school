<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Syllabus;
use App\Models\Subject;
use App\Models\Section;
use App\Models\GradingSystem;
use App\Models\Enrollment;

class ActivityController extends Controller
{
    public function index()
    {
        // Dashboard stats
        $totalStudents = User::where('role', 'student')->count();
        $totalFaculty = User::where('role', 'faculty')->count();
        $totalSubjects = Subject::count();
        $totalSections = Section::count();

        $uploadedSyllabi = Syllabus::count();
        $gradingSystems = GradingSystem::count();
        $recentUploads = Syllabus::with('faculty', 'subject')
            ->latest('upload_timestamp')
            ->take(5)
            ->get();

        // Optional: total enrollments if you have Enrollment model
        $totalEnrollments = class_exists(Enrollment::class) ? Enrollment::count() : 0;

        return view('admin.activities.index', compact(
            'totalStudents',
            'totalFaculty',
            'totalSubjects',
            'totalSections',
            'uploadedSyllabi',
            'gradingSystems',
            'totalEnrollments',
            'recentUploads'
        ));
    }
}

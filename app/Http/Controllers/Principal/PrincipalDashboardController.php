<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Assessment;

class PrincipalDashboardController extends Controller
{
    public function index()
    {
        // Summary counts
        $totalTeachers = Teacher::count();
        $totalStudents = Student::count();
        $totalSections = Section::count();
        $totalSubjects = Subject::count();
        $totalAssessments = Assessment::count();

        // Latest entries
        $latestTeachers = Teacher::latest()->take(5)->get();
        $latestStudents = Student::latest()->take(5)->get();

        // Return to the view with all variables
        return view('principal.dashboard', compact(
            'totalTeachers',
            'totalStudents',
            'totalSections',
            'totalSubjects',
            'totalAssessments',
            'latestTeachers',
            'latestStudents'
        ));
    }
}

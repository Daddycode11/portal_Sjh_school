<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;
use App\Models\Subject;

class PrincipalController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $totalStudents = User::where('user_role', 'client')->count();
        $totalTeachers = User::where('user_role', 'faculty')->count();
        $totalSections = Section::count();
        $totalSubjects = Subject::count();

        $latestTeachers = User::where('user_role', 'faculty')->latest()->take(5)->get();
        $latestStudents = User::where('user_role', 'client')->latest()->take(5)->get();

        return view('principal.dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalSections',
            'totalSubjects',
            'latestTeachers',
            'latestStudents'
        ));
    }

    // Teachers Page
    public function teachers()
    {
        $teachers = User::where('user_role', 'faculty')->paginate(10);
        $totalTeachers = $teachers->total();

        return view('principal.pages.teachers', compact('teachers', 'totalTeachers'));
    }

    // Students Page
    public function students()
    {
        $students = User::where('user_role', 'client')->paginate(10);
        $totalStudents = $students->total();

        return view('principal.pages.students', compact('students', 'totalStudents'));
    }

    // Sections Page
    public function sections()
    {
        $sections = Section::with('advisor')->paginate(10);
        $totalSections = $sections->total();

        return view('principal.pages.sections', compact('sections', 'totalSections'));
    }

    // Subjects Page
    public function subjects()
    {
        $subjects = Subject::paginate(10);
        $totalSubjects = $subjects->total();

        return view('principal.pages.subjects', compact('subjects', 'totalSubjects'));
    }

    // Reports Page
    public function reports()
    {
        $totalStudents = User::where('user_role', 'client')->count();
        $totalTeachers = User::where('user_role', 'faculty')->count();
        $totalSections = Section::count();
        $totalSubjects = Subject::count();

        return view('principal.pages.reports', compact(
            'totalStudents',
            'totalTeachers',
            'totalSections',
            'totalSubjects'
        ));
    }

    // Settings Page
    public function settings()
    {
        $principal = auth()->user();
        return view('principal.pages.settings', compact('principal'));
    }
}

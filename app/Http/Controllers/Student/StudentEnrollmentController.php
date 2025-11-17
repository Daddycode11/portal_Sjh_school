<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;
use App\Models\Enrollment;

class StudentEnrollmentController extends Controller
{
    /**
     * Show the enrollment form
     */
    public function form()
    {
        $gradeLevels = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];
        return view('client.student.enrollment', compact('gradeLevels'));
    }

    /**
     * AJAX: Get sections by grade
     */
    public function getSections($grade)
    {
        $sections = Section::where('grade_level', $grade)->get(['id', 'name']);
        return response()->json($sections);
    }

    /**
     * Submit enrollment
     */
    public function submit(Request $request)
    {
        $request->validate([
            'grade_level' => 'required|string',
            'section_id'  => 'required|exists:sections,id',
            'school_year' => 'required|string',
        ]);

        // Prevent duplicate enrollment for same student, grade, section
        $exists = Enrollment::where('student_id', Auth::id())
            ->where('grade_level', $request->grade_level)
            ->where('section_id', $request->section_id)
            ->first();

        if ($exists) {
            return redirect()->back()->with('error', 'You are already enrolled in this grade/section.');
        }

        Enrollment::create([
            'student_id'  => Auth::id(),
            'grade_level' => $request->grade_level,
            'section_id'  => $request->section_id,
            'school_year' => $request->school_year,
        ]);

        return redirect()->back()->with('success', 'Enrollment submitted successfully!');
    }
}

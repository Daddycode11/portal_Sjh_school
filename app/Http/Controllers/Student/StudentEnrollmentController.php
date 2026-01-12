<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;
use App\Models\Enrollment;
use App\Models\User;

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
        $sections = Section::where('grade_level', $grade)->get(['id', 'name', 'strand']);
        return response()->json($sections);
    }

    /**
     * Submit enrollment
     */
    public function submit(Request $request)
    {
        $request->validate([
            'grade_level'   => 'required|string',
            'section_id'    => 'required|exists:sections,id',
            'school_year'   => 'required|string',
            'semester'      => 'required|string',
            'contact_number'=> 'required|string',
            'email'         => 'required|email',
        ]);

        $student = Auth::user(); // current logged-in student

        // Prevent duplicate enrollment
        $exists = Enrollment::where('student_id', $student->id)
            ->where('grade_level', $request->grade_level)
            ->where('section_id', $request->section_id)
            ->first();

        if ($exists) {
            return redirect()->back()->with('error', 'You are already enrolled in this grade/section.');
        }

        $section = Section::findOrFail($request->section_id);

        Enrollment::create([
            'student_id'     => $student->id,
            'strand'         => $section->strand ?? null,
            'section'        => $section->name ?? null,
            'grade_level'    => $request->grade_level,
            'school_year'    => $request->school_year,
            'semester'       => $request->semester,
            'contact_number' => $request->contact_number,
            'email'          => $request->email,
            'status'         => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Enrollment submitted successfully!');
    }
}

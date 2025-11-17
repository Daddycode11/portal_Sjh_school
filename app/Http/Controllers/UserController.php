<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function form()
    {
        // You can hardcode or fetch from DB. Example hardcoded list:
        $gradeLevels = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];

        return view('student.enrollment', compact('gradeLevels'));
    }

    /**
     * Return JSON list of sections for given grade (AJAX)
     */
    public function getSections($grade)
    {
        // Normalize grade string if needed
        $sections = Section::where('grade_level', $grade)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($sections);
    }

    /**
     * Handle enrollment submit
     */
    public function submit(Request $request)
    {
        $request->validate([
            'grade_level' => 'required|string',
            'section_id'  => 'required|exists:sections,id',
            'school_year' => 'required|string|max:30',
        ]);

        $studentId = Auth::id();

        // Prevent duplicate enrollment for same student + school_year
        $exists = Enrollment::where('student_id', $studentId)
            ->where('school_year', $request->school_year)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'You already have an enrollment for that school year.');
        }

        Enrollment::create([
            'student_id'  => $studentId,
            'grade_level' => $request->grade_level,
            'section_id'  => $request->section_id,
            'school_year' => $request->school_year,
            'status'      => 'pending', // optional default
        ]);

        return redirect()->route('client.enrollment.form')
            ->with('success', 'Enrollment submitted successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class StudentEnrollmentController extends Controller
{
    // Show the modal/form page
    public function form()
    {
        return view('student.enrollment_form');
    }

    // Store enrollment
    public function submit(Request $request)
    {
        $request->validate([
            'student_name'   => 'required|string|max:255',
            'grade_level'    => 'required|string',
            'strand'         => 'required|string',
            'section'        => 'nullable|string|max:50',
            'contact_number' => 'required|string|max:20',
            'email'          => 'required|email|max:255',
        ]);

        Enrollment::create([
            'student_name'   => $request->student_name,
            'grade_level'    => $request->grade_level,
            'strand'         => $request->strand,
            'section'        => $request->section,
            'contact_number' => $request->contact_number,
            'email'          => $request->email,
            'status'         => 'Pending',
        ]);

        return redirect()->route('client.enrollment.form')
                         ->with('success', 'Enrollment submitted successfully! You will be notified once approved.');
    }

    // Optional: AJAX section filtering
    public function getSections($gradeLevelId)
    {
        // Example: return JSON list of sections for the selected grade
        $sections = \DB::table('sections')
                        ->where('grade_level', $gradeLevelId)
                        ->pluck('name', 'id');
        return response()->json($sections);
    }
}

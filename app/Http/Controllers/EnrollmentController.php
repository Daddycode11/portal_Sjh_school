<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject; // Make sure you have a Subject model
use App\Models\Enrollment; // If needed for enrolled subjects

class EnrollmentController extends Controller
{
    // Show enrollment page
    public function index()
    {
        // Count all subjects
        $totalSubjects = Subject::count();

        // Optional: Count subjects the student is enrolled in
        // $studentId = auth()->user()->id;
        // $enrolledSubjects = Enrollment::where('student_id', $studentId)->count();

        // Pass variable to the view
        return view('enrollment.index', compact('totalSubjects'));
    }
}

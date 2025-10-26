<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF; // from barryvdh/laravel-dompdf


class GradeController extends Controller
{
    // Display the grades page
    public function index()
    {
        // Example dummy data (replace this with your database query)
        $subjectGrades = [
            [
                'subject_code' => 'IT101',
                'subject_name' => 'Introduction to Computing',
                'section_name' => 'BSIT-1A',
                'faculty_name' => 'Mr. Santos',
                'midterm_grade' => 87,
                'final_grade' => 90,
                'overall_grade' => 88.5,
                'section_id' => 1,
                'subject_id' => 1,
                'school_year' => '2025-2026',
                'semester' => '1st'
            ],
            [
                'subject_code' => 'CS102',
                'subject_name' => 'Computer Programming',
                'section_name' => 'BSIT-1A',
                'faculty_name' => 'Ms. Dela Cruz',
                'midterm_grade' => 70,
                'final_grade' => 74,
                'overall_grade' => 72,
                'section_id' => 1,
                'subject_id' => 2,
                'school_year' => '2025-2026',
                'semester' => '1st'
            ]
        ];

        // Summary
        $totalGrades = collect($subjectGrades)->sum('overall_grade');
        $totalSubjects = count($subjectGrades);
        $gpa = $totalSubjects > 0 ? $totalGrades / $totalSubjects : 0;
        $passingCount = collect($subjectGrades)->where('overall_grade', '>=', 75)->count();

        return view('client.grades', compact('subjectGrades', 'gpa', 'passingCount', 'totalSubjects'));
    }

    // Export to PDF
    public function exportPDF()
    {
        // Get same data (you can reuse from index or query DB)
        $subjectGrades = [
            [
                'subject_code' => 'IT101',
                'subject_name' => 'Introduction to Computing',
                'section_name' => 'BSIT-1A',
                'faculty_name' => 'Mr. Santos',
                'midterm_grade' => 87,
                'final_grade' => 90,
                'overall_grade' => 88.5,
            ],
            [
                'subject_code' => 'CS102',
                'subject_name' => 'Computer Programming',
                'section_name' => 'BSIT-1A',
                'faculty_name' => 'Ms. Dela Cruz',
                'midterm_grade' => 70,
                'final_grade' => 74,
                'overall_grade' => 72,
            ]
        ];

        $totalGrades = collect($subjectGrades)->sum('overall_grade');
        $totalSubjects = count($subjectGrades);
        $gpa = $totalSubjects > 0 ? $totalGrades / $totalSubjects : 0;
        $passingCount = collect($subjectGrades)->where('overall_grade', '>=', 75)->count();

        $pdf = PDF::loadView('client.grades_pdf', compact('subjectGrades', 'gpa', 'passingCount', 'totalSubjects'));

        return $pdf->download('My_Grades_Report.pdf');
    }
}

<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GradingSystem;
use Illuminate\Support\Facades\DB;

class AdminGradeController extends Controller
{
    public function index()
    {
        // Fetch grading system records
        $gradings = GradingSystem::with('subject')->latest()->get();

        // Summary data
        $totalSubjects = GradingSystem::distinct('subject_id')->count('subject_id');
        $averageQuizPercentage = number_format(GradingSystem::avg('quiz_percentage'), 2);
        $activeSemester = GradingSystem::latest('created_at')->value('semester') ?? 'N/A';

        return view('admin.grades.index', compact(
            'gradings',
            'totalSubjects',
            'averageQuizPercentage',
            'activeSemester'
        ));
    }
}

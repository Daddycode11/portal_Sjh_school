<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Syllabus;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Syllabus::with(['faculty', 'subject'])
            ->orderBy('upload_timestamp', 'desc')
            ->get();

        $totalReports = $reports->count();
        $uniqueSubjects = $reports->pluck('subject_id')->unique()->count();
        $facultyCount = $reports->pluck('faculty_id')->unique()->count();

        return view('admin.reports.index', compact(
            'reports', 'totalReports', 'uniqueSubjects', 'facultyCount'
        ));
    }
}

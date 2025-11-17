<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function index()
    {
        // Load all reports with related faculty, subject, and section
        $reports = Report::with(['faculty', 'subject', 'section'])->latest()->get();

        // Summary cards data
        $totalReports = Report::count();
        $reportTypes = Report::select('report_type', DB::raw('count(*) as total'))
                            ->groupBy('report_type')
                            ->get();
        $latestReport = Report::latest()->first();

        return view('admin.reports.index', compact(
            'reports',
            'totalReports',
            'reportTypes',
            'latestReport'
        ));
    }
}

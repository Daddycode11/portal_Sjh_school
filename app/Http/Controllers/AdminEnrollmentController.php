<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class AdminEnrollmentController extends Controller
{
    // Show ALL enrollments
    public function index()
    {
        $enrollments = Enrollment::orderBy('created_at', 'desc')->get();
        return view('admin.enrollments.index', compact('enrollments'));
    }

    // Show ONLY pending enrollments
    public function requests()
    {
        $pendingEnrollments = Enrollment::where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.enrollments.requests', compact('pendingEnrollments'));
    }

    public function approve($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update(['status' => 'Approved']);

        return back()->with('success', 'Enrollment approved!');
    }

    public function reject($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update(['status' => 'Rejected']);

        return back()->with('success', 'Enrollment rejected!');
    }
}

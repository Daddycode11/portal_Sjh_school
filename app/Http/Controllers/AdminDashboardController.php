<?php
namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\User;
use App\Models\Subject;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Counts for the stat boxes
        $totalEnrollments = Enrollment::count();
        $approved        = Enrollment::where('status', 'Approved')->count();
        $pending         = Enrollment::where('status', 'Pending')->count();
        $rejected        = Enrollment::where('status', 'Rejected')->count();

        // Optionally: latest enrollments for the dashboard table
        $enrollments = Enrollment::orderBy('created_at', 'desc')->take(10)->get();

        // If your view still needs students/subjects elsewhere, include them:
        $students = User::where('user_role', 'client')->get(); // only if view uses $students
        $subjects = Subject::all(); // only if view uses $subjects

        return view('admin.dashboard.index', compact(
            'totalEnrollments',
            'approved',
            'pending',
            'rejected',
            'enrollments',
            'students',
            'subjects'
        ));
    }
}

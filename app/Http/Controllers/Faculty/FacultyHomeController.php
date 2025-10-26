<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement; // announcements model
use Illuminate\Support\Facades\Auth;

class FacultyHomeController extends Controller
{
    public function index()
    {
        // Fetch latest 5 announcements
        $announcements = Announcement::orderBy('posted_at', 'desc')->take(5)->get();

        // Optional placeholders for classes/stats
        $assignedClasses = collect(); // empty collection for now
        $studentCount = 0;
        $syllabiCount = 0;
        $recentActivities = [];

        // Pass all variables to Blade
        return view('faculty.dashboard', compact(
            'assignedClasses',
            'studentCount',
            'syllabiCount',
            'recentActivities',
            'announcements'
        ));
    }
}

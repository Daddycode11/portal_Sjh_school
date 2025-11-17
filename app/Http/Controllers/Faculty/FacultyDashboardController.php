<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassAssignment; // Replace with your actual model
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class FacultyDashboardController extends Controller
{
    public function index()
    {
        $facultyId = Auth::id(); // Get logged-in faculty ID

        // Fetch all assigned classes
        $assignedClasses = ClassAssignment::with(['section', 'subject', 'students', 'syllabi', 'activities'])
            ->where('faculty_id', $facultyId)
            ->get();

        // Count total students across all classes
        $studentCount = $assignedClasses->sum(function ($class) {
            return $class->students->count(); // assumes 'students' relationship
        });

        // Count total uploaded syllabi
        $syllabiCount = $assignedClasses->sum(function ($class) {
            return $class->syllabi->count(); // assumes 'syllabi' relationship
        });

        // Recent activities (latest 5)
        $recentActivities = $assignedClasses->flatMap(function ($class) {
            return $class->activities->map(function ($activity) use ($class) {
                return [
                    'title' => $class->subject->name ?? 'N/A',
                    'description' => $activity->description ?? 'No description',
                    'timestamp' => $activity->created_at ?? now(),
                ];
            });
        })->sortByDesc('timestamp')->take(5)->values()->toArray();

        // Latest announcements (5)
        $announcements = Announcement::orderBy('posted_at', 'desc')->take(5)->get();

        // Pass variables to Blade
        return view('faculty.dashboard', compact(
            'assignedClasses',
            'studentCount',
            'syllabiCount',
            'recentActivities',
            'announcements'
        ));
    }
}

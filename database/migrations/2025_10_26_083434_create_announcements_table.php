<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('posted_at', 'desc')->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'target_audience' => 'required|in:students,faculty,both',
        ]);

        Announcement::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'target_audience' => $request->input('target_audience'),
            'posted_at' => now(),
        ]);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement posted successfully!');
    }

    public function destroy($id)
    {
        Announcement::findOrFail($id)->delete();
        return back()->with('success', 'Announcement deleted successfully!');
    }
}

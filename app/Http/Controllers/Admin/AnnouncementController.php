<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    // Show list of announcements
    public function index()
    {
        $announcements = Announcement::orderBy('posted_at', 'desc')->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    // Show form to create announcement
    public function create()
    {
        return view('admin.announcements.create');
    }

    // Save new announcement
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

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement posted successfully.');
    }

    // Show form to edit announcement
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcements.edit', compact('announcement'));
    }

    // Update existing announcement
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'target_audience' => 'required|in:students,faculty,both',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'target_audience' => $request->input('target_audience'),
        ]);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    // Delete announcement
    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }
}

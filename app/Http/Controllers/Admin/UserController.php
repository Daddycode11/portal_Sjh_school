<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a new student (user).
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|string|unique:users,student_number',
            'major' => 'nullable|string|max:255',
            'sex' => 'nullable|in:M,F',
            'course' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'password' => 'required|string|min:6',
        ]);

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Create the user
        User::create($validated);

        return redirect()->back()->with('success', 'New student added successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User; // Using User model because your table is 'users'
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index()
    {
        $students = User::where('user_role', 'client')->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|string|unique:users,student_number',
            'student_id' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',
            'sex' => 'required|in:M,F',
            'year' => 'required|string|max:10',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'student_number' => $request->student_number,
            'student_id' => $request->student_id,
            'major' => $request->major,
            'sex' => $request->sex,
            'year' => $request->year,
            'password' => Hash::make($request->password),
            'user_role' => 'client',
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Show the form for editing a student.
     */
    public function edit(User $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the student in storage.
     */
    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|string|unique:users,student_number,' . $student->id,
            'student_id' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',
            'sex' => 'required|in:M,F',
            'year' => 'required|string|max:10',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $student->update([
            'name' => $request->name,
            'student_number' => $request->student_number,
            'student_id' => $request->student_id,
            'major' => $request->major,
            'sex' => $request->sex,
            'year' => $request->year,
            'password' => $request->password ? Hash::make($request->password) : $student->password,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Delete a student.
     */
    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}

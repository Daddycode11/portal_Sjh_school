<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
    // List all students
    public function index()
    {
        $students = User::where('user_role', 'client')->get();
        return view('admin.students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        return view('admin.students.create');
    }

    // Store new student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|string|unique:users,student_number',
            'student_id' => 'nullable|string|unique:users,student_id',
            'major' => 'nullable|string|max:255',
            'gender' => 'required|in:M,F',
            'grade_level' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'student_number' => $request->student_number,
            'student_id' => $request->student_id,
            'major' => $request->major,
            'gender' => $request->gender,
            'grade_level' => $request->grade_level,
            'password' => Hash::make($request->password),
            'user_role' => 'client',
        ]);

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student created successfully.');
    }

    // Show edit form
    public function edit(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|string|unique:users,student_number,' . $student->id,
            'student_id' => 'nullable|string|unique:users,student_id,' . $student->id,
            'major' => 'nullable|string|max:255',
            'gender' => 'required|in:M,F',
            'grade_level' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $student->update([
            'name' => $request->name,
            'student_number' => $request->student_number,
            'student_id' => $request->student_id,
            'major' => $request->major,
            'gender' => $request->gender,
            'grade_level' => $request->grade_level,
            'password' => $request->password ? Hash::make($request->password) : $student->password,
        ]);

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student updated successfully.');
    }

    // Delete student
    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')
                         ->with('success', 'Student deleted successfully.');
    }
}

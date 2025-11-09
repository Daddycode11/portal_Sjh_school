<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
public function index()
{
    $students = Student::all();
    return view('client.dashboard', compact('students'));
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
            'major' => 'required|string|max:255',
            'sex' => 'required|string|in:M,F',
            'course' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Student::create([
            'name' => $request->name,
            'student_number' => $request->student_number,
            'major' => $request->major,
            'sex' => $request->sex,
            'course' => $request->course,
            'year' => $request->year,
            'password' => bcrypt($request->password),
            'user_role' => 'client', // automatically student
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|string|unique:users,student_number,' . $student->id,
            'major' => 'required|string|max:255',
            'sex' => 'required|string|in:M,F',
            'course' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $student->update([
            'name' => $request->name,
            'student_number' => $request->student_number,
            'major' => $request->major,
            'sex' => $request->sex,
            'course' => $request->course,
            'year' => $request->year,
            'password' => $request->password ? bcrypt($request->password) : $student->password,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}

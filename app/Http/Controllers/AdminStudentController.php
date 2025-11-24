<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'student_id' => 'required|unique:students,student_id',
            'major' => 'nullable',
            'gender' => 'required',
            'grade_level' => 'required',
        ]);

        Student::create($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required',
        'student_id' => 'required|unique:users,student_id,' . $student->id,
        'major' => 'nullable',
        'gender' => 'required',
        'grade_level' => 'required',
    ]);

    $student->update($validated);

    return redirect()->route('admin.students.index')
                     ->with('success', 'Student updated successfully.');
}
    public function destroy($id)
    {
        Student::destroy($id);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|string|unique:users,student_number',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6',
            'birth_date' => 'required|date',
            'gender' => 'required',
        ]);

        // Calculate age dynamically
        $dob = new \DateTime($request->birth_date);
        $today = new \DateTime();
        $age = $today->diff($dob)->y;

        // Create student user
        $user = User::create([
            'name' => $request->name,
            'student_number' => $request->student_number,
            'major' => $request->major,
            'sex' => $request->sex,
            'course' => $request->course,
            'year' => $request->year,
            'user_role' => 'student',
            'password' => Hash::make($request->password),
            'profile_picture' => $request->profile_picture ?? null,
            'lrn' => $request->lrn,
            'grade_level' => $request->grade_level,
            'strand' => $request->strand,
            'section' => $request->section,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'age' => $age,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'parent_name' => $request->parent_name,
            'relationship' => $request->relationship,
            'parent_contact' => $request->parent_contact,
            'parent_email' => $request->parent_email,
        ]);

        return redirect()->back()->with('success', 'Student account created successfully!');
    }
}

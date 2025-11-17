<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;

class AdminEnrollmentController extends Controller
{
    public function index()
    {
        $requests = Enrollment::where('status', 'pending')->get();
        return view('admin.enrollment.index', compact('requests'));
    }

    public function approve($id)
    {
        $req = Enrollment::findOrFail($id);
        $req->status = 'approved';
        $req->save();

        return back()->with('success', 'Enrollment approved.');
    }

    public function reject($id)
    {
        $req = Enrollment::findOrFail($id);
        $req->status = 'rejected';
        $req->save();

        return back()->with('error', 'Enrollment rejected.');
    }
}

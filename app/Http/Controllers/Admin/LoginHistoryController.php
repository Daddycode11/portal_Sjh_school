<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;

class LoginHistoryController extends Controller
{
    public function index()
    {
        $histories = LoginHistory::with('user')->orderBy('logged_in_at', 'desc')->get();
        return view('admin.login-history', compact('histories'));
    }
}

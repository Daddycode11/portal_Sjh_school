<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\LoginHistory; // ✅ Add this line

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'student_number' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('student_number', 'password');

        // Debug logging
        Log::debug('Attempting login with: ' . $request->student_number);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();

            Log::debug('Login successful for: ' . $user->name . ' (Role: ' . $user->user_role . ')');

            /**
             * ✅ Record the login history
             */
            LoginHistory::create([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'logged_in_at' => now(),
            ]);

            /**
             * ✅ Redirect based on role
             */
            switch ($user->user_role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'faculty':
                    return redirect()->route('faculty.dashboard');
                case 'client':
                    return redirect()->route('client.dashboard');
                case 'principal': // Additional principal account
                    return redirect()->route('principal.dashboard');
                default:
                    Auth::logout();
                    return back()->withErrors(['student_number' => 'Unauthorized role.']);
            }
        } else {
            Log::debug('Login failed for: ' . $request->student_number);

            return back()->withErrors([
                'student_number' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('welcome');
    }
}

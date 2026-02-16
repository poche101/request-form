<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle the login submission.
     */
    public function login(Request $request)
    {
        // 1. Validate the input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt to log the user in
        // The 'remember' checkbox value is passed as the second argument
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // 3. Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            // 4. Redirect to intended page (dashboard) or default to /dashboard
            return redirect()->intended('/dashboard');
        }

        // 5. If login fails, throw a validation error back to the view
        throw ValidationException::withMessages([
            'email' => __('The provided credentials do not match our records.'),
        ]);
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

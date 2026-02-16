<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ITRequestController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('requests.create');
});

Route::get('/submit-request', [ITRequestController::class, 'create'])
    ->name('requests.create');

Route::post('/submit-request', [ITRequestController::class, 'store'])
    ->name('requests.store');

Route::get('/download-template', [ITRequestController::class, 'downloadTemplate'])
    ->name('template.download');


/*
|--------------------------------------------------------------------------
| Authentication Routes (Manual)
|--------------------------------------------------------------------------
*/

// Display the Login Page
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

// Handle Login Submission
Route::post('/login', function (Request $request) {

    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Attempt to log the user in
    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        // Redirect to intended dashboard or default /dashboard
        return redirect()->intended(route('dashboard'));
    }

    // If authentication fails, return with error message
    return back()
        ->withErrors(['email' => 'The provided credentials do not match our records.'])
        ->onlyInput('email');

})->name('login.post');

// Handle Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');


/*
|--------------------------------------------------------------------------
| Protected IT Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [ITRequestController::class, 'index'])
        ->name('dashboard');

    // Status Update (WEB FLOW)
    Route::put('/requests/{id}/status', [ITRequestController::class, 'updateStatus'])
        ->name('requests.status');

    // Delete Request
    Route::delete('/requests/{id}', [ITRequestController::class, 'destroy'])
        ->name('requests.destroy');
});

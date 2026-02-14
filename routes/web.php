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

Route::get('/download-template', [ITRequestController::class, 'downloadTemplate'])->name('template.download');


/*
|--------------------------------------------------------------------------
| Authentication Routes (Manual)
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (Request $request) {

    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard'));
    }

    return back()
        ->withErrors(['email' => 'Invalid credentials'])
        ->onlyInput('email');

})->name('login.post');

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

    // ✅ Status Update (WEB FLOW)
    Route::put('/requests/{id}/status', [ITRequestController::class, 'updateStatus'])
        ->name('requests.status');

    // Delete Request (optional admin action)
    Route::delete('/requests/{id}', [ITRequestController::class, 'destroy'])
        ->name('requests.destroy');
});

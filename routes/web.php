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

// Route::get('/download-template', [ITRequestController::class, 'downloadTemplate'])
//     ->name('template.download');

Route::get('/download-template', function () {
    // Try these paths one by one:

    $possibleFiles = [
        public_path('PRD_Template.docx'),
        public_path('templates/PRD_Template.docx'),
        public_path('PRD_Template.doc'),
        public_path('template.docx'),
    ];

    foreach ($possibleFiles as $file) {
        if (file_exists($file)) {
            return response()->download($file, basename($file));
        }
    }

    // If no file found, show clear error
    return response()->json([
        'error' => 'File not found',
        'checked_paths' => $possibleFiles
    ], 404);
})->name('template.download');


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

    // Dashboard Listing
    Route::get('/dashboard', [ITRequestController::class, 'index'])
        ->name('dashboard');

    // Status Update (WEB FLOW)
    Route::put('/requests/{id}/status', [ITRequestController::class, 'updateStatus'])
        ->name('requests.status');

    // Secure Ticket Attachment Download
    Route::get('/tickets/{id}/download', [ITRequestController::class, 'downloadAttachment'])
        ->name('tickets.download');

    // Delete Request
    Route::delete('/requests/{id}', [ITRequestController::class, 'destroy'])
        ->name('requests.destroy');
});

<?php

use App\Http\Controllers\InternshipApplicantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    /**
     * Profile Controller
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Internship Applicants Controller
     */
    Route::prefix('internship-applicants')
        ->name('internship-applicants.')
        ->group(function () {
            Route::get('/', [InternshipApplicantController::class, 'index'])->name('index');
            Route::get('/{application}', [InternshipApplicantController::class, 'show'])->name('show');
            Route::get('/{application}/print', [InternshipApplicantController::class, 'print'])->name('print');
        });
});

require __DIR__.'/auth.php';

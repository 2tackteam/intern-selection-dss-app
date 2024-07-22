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
            //Route::get('create', [InternshipApplicantController::class, 'create'])->name('create');
            //Route::post('/', [InternshipApplicantController::class, 'store'])->name('store');
        });
});

require __DIR__.'/auth.php';

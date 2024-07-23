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
            Route::get('/applicant/selection', [InternshipApplicantController::class, 'applicantSelection'])->name('applicant-selection');
        });


    /**
     * Application Submissions Controller
     */
    Route::prefix('application-submissions')
        ->name('application-submissions.')
        ->group(function () {
            Route::get('/', [\App\Http\Controllers\ApplicationSubmissionController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\ApplicationSubmissionController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\ApplicationSubmissionController::class, 'store'])->name('store');
            Route::get('/{application}', [\App\Http\Controllers\ApplicationSubmissionController::class, 'show'])->name('show');
            Route::get('/{application}/print', [\App\Http\Controllers\ApplicationSubmissionController::class, 'print'])->name('print');
        });
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ApplicationSubmissionController;
use App\Http\Controllers\InternshipApplicantController;
use App\Http\Controllers\InternshipApplicantSelectionController;
use App\Http\Controllers\InternshipApplicationSelectionResultController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
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
            Route::delete('/{application}', [InternshipApplicantController::class, 'destroy'])->name('destroy');
        });

    // Admin
    Route::prefix('internship-applicant-selections')
        ->name('internship-applicant-selections.')
        ->group(function () {

            Route::get('/', [InternshipApplicantSelectionController::class, 'index'])->name('index');
            Route::post('/process', [InternshipApplicantSelectionController::class, 'processSelection'])->name('process-selection');

            Route::get('/result', [InternshipApplicantSelectionController::class, 'viewSelectionResult'])->name('result');
            Route::post('/result/process', [InternshipApplicantSelectionController::class, 'processSelectionResult'])->name('process-result');
        });

    Route::prefix('internship-applicant-selection-results')
        ->name('internship-applicant-selection-results.')
        ->group(function () {
            Route::get('/', [InternshipApplicationSelectionResultController::class, 'index'])->name('index');
            Route::get('/print', [InternshipApplicationSelectionResultController::class, 'print'])->name('print');
        });

    // Users
    /**
     * Application Submissions Controller
     */
    Route::prefix('application-submissions')
        ->name('application-submissions.')
        ->group(function () {
            Route::get('/', [ApplicationSubmissionController::class, 'index'])->name('index');
            Route::get('/create', [ApplicationSubmissionController::class, 'create'])->name('create');
            Route::post('/', [ApplicationSubmissionController::class, 'store'])->name('store');
            Route::get('/{application}', [ApplicationSubmissionController::class, 'show'])->name('show');
            Route::patch('/{application}/submit', [ApplicationSubmissionController::class, 'submit'])->name('submit');
            Route::get('/{application}/edit', [ApplicationSubmissionController::class, 'edit'])->name('edit');
            Route::patch('/{application}/update', [ApplicationSubmissionController::class, 'update'])->name('update');
            Route::delete('/{application}', [ApplicationSubmissionController::class, 'destroy'])->name('destroy');
            Route::get('/{application}/print', [ApplicationSubmissionController::class, 'print'])->name('print');
        });
});

require __DIR__.'/auth.php';

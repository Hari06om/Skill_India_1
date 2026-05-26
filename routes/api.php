<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrainerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Public Job Routes (View only)
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/search', [JobController::class, 'search']);
Route::get('/jobs/filter', [JobController::class, 'filter']);
Route::get('/jobs/{id}', [JobController::class, 'show']);

// Public Skill Routes
Route::get('/skills', [SkillController::class, 'index']);
Route::get('/skills/search', [SkillController::class, 'search']);

// Public Trainer Routes
Route::get('/trainers', [TrainerController::class, 'index']);

// Protected Routes (Authenticated Users Only)
Route::middleware('auth:sanctum')->group(function () {
    // Auth Routes
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/profile', [AuthController::class, 'profile']);
    Route::put('/auth/profile', [AuthController::class, 'updateProfile']);

    // Trainer Routes
    Route::post('/appointments', [TrainerController::class, 'bookAppointment']);
    Route::get('/appointments', [TrainerController::class, 'userAppointments']);

    // Job Routes (Employer Only)
    Route::group(['prefix' => 'jobs'], function () {
        Route::post('/', [JobController::class, 'store']); // Create job
        Route::put('/{id}', [JobController::class, 'update']); // Update job
        Route::delete('/{id}', [JobController::class, 'destroy']); // Delete job
        Route::get('/employer/listings', [JobController::class, 'employerListings']); // Get employer's jobs
    });

    // Job Application Routes
    Route::group(['prefix' => 'applications'], function () {
        Route::post('/', [JobApplicationController::class, 'store']); // Apply for job
        Route::get('/', [JobApplicationController::class, 'index']); // Get user applications
        Route::get('/{id}', [JobApplicationController::class, 'show']); // Get application details
        Route::put('/{id}', [JobApplicationController::class, 'update']); // Update application status
        Route::delete('/{id}', [JobApplicationController::class, 'destroy']); // Withdraw application
    });

    // Professional Routes
    Route::group(['prefix' => 'professionals'], function () {
        Route::get('/', [ProfessionalController::class, 'index']); // Search professionals
        Route::get('/{id}', [ProfessionalController::class, 'show']); // Get professional profile
        Route::post('/', [ProfessionalController::class, 'store']); // Create profile
        Route::put('/{id}', [ProfessionalController::class, 'update']); // Update profile
        Route::post('/search', [ProfessionalController::class, 'search']); // Search professionals
    });

    // Skills Routes
    Route::group(['prefix' => 'skills'], function () {
        Route::post('/', [SkillController::class, 'store']); // Create skill (admin)
        Route::put('/{id}', [SkillController::class, 'update']); // Update skill (admin)
        Route::delete('/{id}', [SkillController::class, 'destroy']); // Delete skill (admin)
    });
});

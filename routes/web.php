<?php

use App\Http\Livewire\Users;
use App\Http\Livewire\Chat\Index;
use App\Http\Livewire\Chat\Chat;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//boang
// Redirect to the appropriate dashboard based on user role
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'therapist') {
        return redirect()->route('therapist.dashboard');
    } elseif ($user->role === 'patient') {
        return redirect()->route('patients.dashboard');
    } elseif ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        abort(403, 'Unauthorized');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/createcontent', [ContentController::class, 'create'])->name('admin.content');
    Route::get('/content/create', [ContentController::class, 'create'])->name('content.create');
    Route::post('/content/store', [ContentController::class, 'store'])->name('content.store');
});

// Therapist routes
Route::middleware(['auth', 'role:therapist'])->group(function () {
    Route::get('/therapist/dashboard', [TherapistController::class, 'index'])->name('therapist.dashboard');
    Route::get('/therapist/appointment', [TherapistController::class, 'appIndex'])->name('therapist.appointment');
    
    // New therapist-specific routes
    Route::get('/therapist/schedule', [TherapistController::class, 'schedule'])->name('therapist.schedule');
    Route::get('/therapist/view-session', [TherapistController::class, 'viewSession'])->name('therapist.viewSession');
    Route::get('/therapist/progress', [TherapistController::class, 'progress'])->name('therapist.progress');
});

// Patient routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patients.dashboard');
    Route::get('/patient/appointment', [PatientController::class, 'viewApp'])->name('patients.appointment');
    Route::post('/patient/appointment/{appointmentID}', [AppointmentController::class, 'cancelApp'])->name('patients.cancelApp');
    Route::get('/patient/bookappointment', [PatientController::class, 'appIndex'])->name('patients.bookappointments');
    Route::get('/patient/bookappointment/{id}', [PatientController::class, 'appDetails'])->name('patients.therapist-details');
    Route::post('/patient/bookappointment/store', [AppointmentController::class, 'store'])->name('appointments.store');

    // New patient-specific route
    Route::get('/patient/progress', [PatientController::class, 'progress'])->name('patients.progress');
});

// Chat and users (Livewire components)
Route::middleware('auth')->group(function () {
    Route::get('/chat', Index::class)->name('chat.index');
    Route::get('/chat/{query}', Chat::class)->name('chat');
    Route::get('/users', Users::class)->name('users');
});

// Profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__.'/auth.php';

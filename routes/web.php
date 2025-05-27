<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ReportController;

// Homepage route, returns the welcome view
Route::get('/', function () {
    return view('welcome');
});

// Login form page
Route::get('/login', function () {
    return view('login'); 
})->name('login');

// Login form submission, handled by AuthController@login
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Logout route, handled by AuthController@logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); // or Route::post()

// Dashboard page after login
Route::get('/dashboard', function (){
    return view('dashboard');
})->name('dashboard');

// Registration form page
Route::get('/register', function () {
    return view('registration');
})->name('register');

// Registration form submission, handled by RegistrationController@save
Route::post('/register', [RegistrationController::class, 'save'])->name('register.save');

// Profile edit page for changing name/username, handled by ProfileController@edit
Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');

// Profile update submission, handled by ProfileController@update
Route::post('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');

// Password edit form, handled by PasswordController@edit
Route::get('/edit-password', [PasswordController::class, 'edit'])->name('password.edit');

// Password update submission, handled by PasswordController@update
Route::post('/edit-password', [PasswordController::class, 'update'])->name('password.update');

// Display list of users, handled by UserController@index
Route::get('/users', [UserController::class, 'index'])->name('user.list');

// Delete a specific user by ID, handled by UserController@destroy
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// Grouped routes that might require middleware (e.g., auth), currently empty middleware array
Route::middleware([])->group(function () {

    // Show upload form, handled by UploadController@create
    Route::get('/upload', [UploadController::class, 'create'])->name('upload.create');

    // Handle file upload submission, handled by UploadController@store
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');

    // Show list of user’s uploads, handled by UploadController@index
    Route::get('/my-uploads', [UploadController::class, 'index'])->name('upload.index');

    // Download uploaded file, handled by UploadController@download
    Route::get('/download/{upload}', [UploadController::class, 'download'])->name('upload.download');

    // Delete an uploaded file, handled by UploadController@destroy
    Route::delete('/upload/{upload}', [UploadController::class, 'destroy'])->name('upload.destroy');

    // Verify email from a token link, handled by AuthController@verifyEmail
    Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');

    // Show email verification request form, handled by EmailVerificationController@showVerificationForm
    Route::get('/verify-email', [EmailVerificationController::class, 'showVerificationForm'])->name('verify.email.form');

    // Send verification email, handled by EmailVerificationController@sendVerificationEmail
    Route::post('/verify-email', [EmailVerificationController::class, 'sendVerificationEmail'])->name('verify.email.send');

    // Verify token from email, handled by EmailVerificationController@verifyToken
    Route::get('/verify-email-token/{token}', [EmailVerificationController::class, 'verifyToken'])->name('verify.email.token');

    // Show forgot password form, handled by ForgotPasswordController@showRequestForm
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequestForm'])->name('password.request');

    // Send password reset link to email, handled by ForgotPasswordController@sendResetLink
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

    // Show password reset form using token, handled by ResetPasswordController@showResetForm
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

    // Submit new password, handled by ResetPasswordController@reset
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.change');

    // Export user list to file (e.g., Excel), handled by UserController@export
    Route::get('/users/export', [UserController::class, 'export'])->name('user.export');

    // Admin view of reports, handled by ReportController@index
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
});

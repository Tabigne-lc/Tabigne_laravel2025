<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/users', function () {
    return view('users');
})->name('users');

Route::get('/edit-profile', function () {
    return view('edit-profile');
})->name('edit-profile');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/edit-password', function () {
    return view('edit-password');
})->name('edit-password');

Route::get('/uploaded-files', function () {
    return view('uploaded-files');
})->name('uploaded-files');
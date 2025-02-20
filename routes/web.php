<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view("welcome");
});

Route::get('/admin', function () {
    return 'hello admin';
})->middleware('checkIfAdmin');



Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [AuthController::class, 'register']);




// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');



Route::get('/dashboard', function () {
    return "hi";
})->middleware('auth')->name('dashboard');
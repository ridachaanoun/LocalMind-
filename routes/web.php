<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\QuestionController;

use App\Http\Controllers\AnswerController;


// Route::get('/', function () {
//     return view("welcome");
// });
Route::get('/', [QuestionController::class, 'index'])->name('questions.index');

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



Route::resource('questions', QuestionController::class)->middleware('auth');



Route::post('/questions/{id}/answers', [AnswerController::class, 'store'])->name('questions.answer')->middleware('auth');

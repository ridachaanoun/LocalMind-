<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\test;

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FavoriteController;


Route::get('/', [QuestionController::class, 'index'])->middleware("auth")->name('questions.index');

Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/questions', [QuestionController::class, 'index'])->middleware('auth')->name('questions.index');
Route::get('/questions/create', [QuestionController::class, 'create'])->middleware('auth')->name('questions.create');
Route::post('/questions', [QuestionController::class, 'store'])->middleware('auth')->name('questions.store');
Route::get('/questions/{question}', [QuestionController::class, 'show'])->middleware('auth')->name('questions.show');
Route::post('/questions/{id}/answers', [AnswerController::class, 'store'])->name('questions.answer')->middleware('auth');

Route::post('/questions/{id}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/questions/{id}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

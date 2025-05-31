<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\GradeController;

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/signin', [AuthController::class, 'showSignin'])->name('login');
Route::post('/signin', [AuthController::class, 'signin']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Example protected routes:
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::get('/schedule', [ScheduleController::class, 'index'])
        ->name('schedule');
    Route::get('/grade', [GradeController::class, 'index'])->name('grade');
    Route::get('/service', [ServiceController::class, 'service'])->name('member.service');
    // ...add all feature routes here
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    Route::get('/schedule', [ScheduleController::class, 'index'])
        ->name('schedule');
});

    Route::get('/grade', [GradeController::class, 'index'])->name('grade');
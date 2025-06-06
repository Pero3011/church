<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\served;
use App\Http\Controllers\YourController;

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/signin', [AuthController::class, 'showSignin'])->name('login');
Route::post('/signin', [AuthController::class, 'signin']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');


Route::get('/grade', [GradeController::class, 'index'])->name('grade');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');
Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
Route::get('/served', [served::class, 'showUsers'])->name('served');
Route::delete('/served/{user}', [served::class, 'destroy'])->name('user.destroy');
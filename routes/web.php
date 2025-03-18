<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\JobVacancieController;
use App\Http\Controllers\UserController;

Route::get('/login',    [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');
Route::middleware(['web'])->group(function () {
    Route::get('/register', [RegisterController::class, 'show'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
});
Route::middleware('auth')->group(function () {
    Route::get('/',                         [JobVacancieController::class, 'index'])->name('index');
    Route::get('/jobs/create',              [JobVacancieController::class, 'create'])->name('jobs.create');
    Route::post('/jobs/create',             [JobVacancieController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}',                [JobVacancieController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{id}/apply',         [JobVacancieController::class, 'apply'])->name('jobs.apply');
    Route::put('/jobs/{id}',                [JobVacancieController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}',             [JobVacancieController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/users',                    [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create',             [UserController::class, 'create'])->name('users.create');
    Route::post('/users/create',            [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/',              [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}/update',        [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}/destroy',    [UserController::class, 'destroy'])->name('users.delete');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Models\Account;

Route::get('/', function () {
    return view('Auth.login');
});

Route::get('/login', [AccountController::class,'loginForm'])->name('login');
Route::get('/register', [AccountController::class,'registerForm'])->name('register');
Route::get('/home', [AccountController::class,'home'])->name('home_movie');

Route::post('/register', [AccountController::class,'register'])->name('make_register');
Route::post('/login', [AccountController::class, 'login'])->name('login');
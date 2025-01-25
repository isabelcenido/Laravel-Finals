<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Storage;
use App\Models\Account;
use App\Models\Movies;

Route::view('/', 'Auth.login')->middleware('guest');

Route::get('/login', [AccountController::class,'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AccountController::class, 'login'])->name('loginAccess')->middleware('guest');

Route::get('/register', [AccountController::class,'registerForm'])->name('register')->middleware('guest');
Route::post('/register', [AccountController::class,'register'])->name('make_register')->middleware('guest');

Route::get('/home', [AccountController::class, 'home'])->name('home_movie');
Route::get('/admin_home', [MoviesController::class, 'getMovies'])->name('adminpage');

Route::get('/genres', [MoviesController::class, 'index']);
Route::post('/genres', [MoviesController::class, 'store']);
Route::delete('/genres/{id}', [MoviesController::class, 'destroy']);
Route::post('/movies', [MoviesController::class, 'movieStore']);

Route::get('/movies/{id}', function ($id) {
    $movie = App\Models\Movies::with('genre')->findOrFail($id);

    $posterUrl = Storage::url($movie->image);

    return response()->json([
        'title' => $movie->title,
        'genre' => $movie->genre,
        'release_date' => $movie->release_date,
        'duration' => $movie->duration,
        'description' => $movie->description,
        'cast' => $movie->cast,
        'ratings' => $movie->ratings,
        'poster' => $posterUrl,
    ]);
});

Route::get('/editmovies/{id}', function ($id) {
    $movie = Movies::findOrFail($id);
    return response()->json($movie);
});

Route::post('/movies/{id}',[MoviesController::class, 'editMovie']);



<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Storage;
use App\Models\Account;
use App\Models\Movies;

Route::get('/login', [AccountController::class,'loginForm'])->name('login');
Route::post('/login', [AccountController::class, 'login'])->name('loginAccess');

Route::get('/register', [AccountController::class,'registerForm'])->name('register');
Route::post('/register', [AccountController::class,'register'])->name('make_register');

Route::get('/', [AccountController::class, 'home'])->name('home_movie');
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
Route::delete('/movies/{id}', function ($id) {
    $movie = Movies::findOrFail($id);

    $movie->delete();

    return response()->json(['success' => true]);
});

Route::get('/search', [AccountController::class, 'search']);

Route::post('/logout', [AccountController::class, 'logout'])->name('logout');



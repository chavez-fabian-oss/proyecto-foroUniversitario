<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SubredditController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

// Rutas de autenticación
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Ruta de bienvenida
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas accesibles solo para usuarios autenticados y verificados
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard'); // Actualización aquí

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de posts
    Route::resource('posts', PostController::class);

    // Rutas de subreddits
    Route::resource('subreddits', SubredditController::class);
    Route::post('subreddits/{subreddit}/join', [SubredditController::class, 'join'])->name('subreddits.join');
    Route::post('subreddits/{subreddit}/leave', [SubredditController::class, 'leave'])->name('subreddits.leave');
    Route::get('/subreddits/{subreddit}/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/subreddits/{subreddit}/posts', [PostController::class, 'store'])->name('posts.store');

    // Rutas de comentarios
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Rutas de votos
    Route::post('votes', [VoteController::class, 'store'])->name('votes.store');
});

// Requiere las rutas de autenticación predeterminadas de Laravel Breeze
require __DIR__.'/auth.php';

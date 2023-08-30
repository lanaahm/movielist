<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MainConteoller;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainConteoller::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store']);

Route::get('/actor', [ActorController::class, 'index']);
Route::get('/actor/{actor:slug}', [ActorController::class, 'show']);

Route::get('/movie', [MainConteoller::class, 'index']);
Route::get('/movie/{movie:slug}', [MainConteoller::class, 'show']);
Route::get('/movie/sorted/{sorted}', [MainConteoller::class, 'index']);
Route::get('/movie/genre/{genre:slug}', [MainConteoller::class, 'index']);

Route::middleware(['auth'])->group(function () { 
    Route::get('/profile/{user}', [AuthController::class, 'show']);
    Route::put('/profile/{user}', [AuthController::class, 'update']);
    Route::put('/profile/avatar/{user}', [AuthController::class, 'updateAvatar']);

    Route::get('/watchlist', [WatchlistController::class, 'index']);
    Route::post('/watchlist', [WatchlistController::class, 'store']);
    Route::put('/watchlist/{watchlist}', [WatchlistController::class, 'update']);
    Route::get('/watchlist/sorted/{sorted}', [WatchlistController::class, 'index']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth', 'isAdmin'])->group(function () { 
    Route::get('/actor_add', [ActorController::class, 'create']);
    Route::post('/actor_add', [ActorController::class, 'store']);
    Route::get('/actor_update/{actor:slug}', [ActorController::class, 'edit']);
    Route::put('/actor_update/{actor:slug}', [ActorController::class, 'update']);
    Route::delete('/actor/{actor:slug}', [ActorController::class, 'destroy']);

    Route::get('/movie_add', [MovieController::class, 'create']);
    Route::post('/movie_add', [MovieController::class, 'store']);
    Route::get('/movie_update/{movie:slug}', [MovieController::class, 'edit']);
    Route::put('/movie_update/{movie:slug}', [MovieController::class, 'update']);
    Route::delete('/movie/{movie:slug}', [MovieController::class, 'destroy']);
    
});




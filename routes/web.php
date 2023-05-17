<?php

use App\Http\Controllers\GoogleSocialiteController;
use App\Models\Scam;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'usersCount'=> User::all()->count(),
        'scamsCount'=> Scam::all()->count(),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // });

    //Dashboard
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    //Users
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/restore/{id}', [App\Http\Controllers\UserController::class, 'restore'])->name('users.restore');

    //Scams
    Route::resource('/scams', App\Http\Controllers\ScamController::class);
    Route::get('/upload', [App\Http\Controllers\FileController::class, 'upload']);

    //Search
    Route::get('search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
});
//Google Auth
Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleGoogleCallback']);
<?php

use App\Http\Controllers\GoogleSocialiteController;
use App\Http\Controllers\FacebookSocialiteController;
use App\Models\Scam;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScamController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
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
    $directory = storage_path('/app/public/scam_files');
    $filesCount = File::exists($directory) ? count(File::allFiles($directory)) : 0;
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'usersCount' => User::all()->count(),
        'filesCount' => $filesCount,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    //Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    //Users
    Route::middleware(['admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    });

    //CommentPosts
    Route::middleware(['moderator'])->group(function () {
    });

    //Scams
    Route::resource('/scams', ScamController::class);

    //Comments
    Route::get('comments', [CommentController::class, 'index']);
    Route::get('comments/{id}', [CommentController::class, 'show'])->name('comments');
    Route::post('scams/{id}/comments', [CommentController::class, 'store']);
    Route::delete('comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    //File upload
    Route::post('/upload', [FileController::class, 'upload']);

    //Search
    Route::get('search', [SearchController::class, 'index'])->name('search.index');
});

//Google Auth
Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleGoogleCallback']);

//Facebook Auth
Route::get('auth/facebook', [FacebookSocialiteController::class, 'redirectToFacebook']);
Route::get('callback/facebook', [FacebookSocialiteController::class, 'handleFacebookCallback']);

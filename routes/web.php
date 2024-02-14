<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProjectController;
use App\Http\Controllers\UserServiceController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

/**
 * Home page route
 * Can be accessed by anyone
 */
Route::get('/', function () {
    return view('pages.home.index');
})->name('home');

/**
 * Middleware group for authenticated users
 * All routes in this group will be accessible only by authenticated users
 */
Route::middleware('auth')->group(function () {
    /**
     * Route to change the theme
     * Will store the theme in a cookie and redirect back to the previous page
     */
    Route::patch('/theme/{theme}', function (string $theme) {
        $cookie = cookie()->forever('theme', $theme, '/', null, null, false, false);

        return redirect()->back()->cookie($cookie);
    })->name('theme.update');

    /**
     * Routes to manage the services and projects
     * Only the delete and destroy methods are available to the user
     */
    Route::resource('services', ServiceController::class)->only(['update', 'destroy']);
    Route::resource('projects', ProjectController::class)->only(['update', 'destroy']);

    /**
     * Routes for the user to manage their own resources
     */
    Route::resource('my-projects', UserProjectController::class);
    Route::resource('browse-services', UserServiceController::class);

    /**
     * Profile routes to manage the user's profile
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Middleware group for admin users
 * All routes in this group will be accessible only by admin users
 */
Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class)->except(['update', 'destroy']);
    Route::resource('projects', ProjectController::class)->except(['update', 'destroy']);
});


/**
 * Authentication routes
 * Routes to manage the authentication of the application
 */
require __DIR__ . '/auth.php';

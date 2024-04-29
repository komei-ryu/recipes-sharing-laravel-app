<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FavoriteController;

// show the register form page
Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
// process register
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');
// show the login form page
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
// process login
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

/* middleware: functions that run before the route's controller method gets hit */
/* Inside the function argument for group(), put all routes that require 
authentication. */
/* middleware(['auth']) corresponds to app/Http/Middleware/Authenticate.php */
/* Now, if the user is not logged in, if the user tries to access routes inside group(), the 
user will be redirected to route('login') according to app/Http/Middleware/Authenticate.php */
/* The mapping between 'auth' and \App\Http\Middleware\Authenticate::class happens
in app/Http/Kernel.php */
Route::middleware(['auth'])->group(function () {
    // home page that displays all recipes
    Route::get('/recipes', [RecipeController::class, 'index'])->name('recipe.index');
    // show the recipe creation form page
    Route::get('/recipes/new', [RecipeController::class, 'create'])->name('recipe.create');
    // process recipe creation
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipe.store');
    // show the recipe detail page
    Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipe.show');
    
    // favorites page that displays all recipes favorited by the current user
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
    // process adding recipes to favorites
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorite.store');
    // process removing a recipe from favorites
    Route::post('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

    // logout user
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

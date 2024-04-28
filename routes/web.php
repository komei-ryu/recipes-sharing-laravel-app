<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;

// show the register form page
Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
// process register
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');
// logout user
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
// show the login form page
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
// process login
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// home page that displays all recipes
Route::get('/', [RecipeController::class, 'index'])->name('recipe.index');

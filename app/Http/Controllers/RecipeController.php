<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; // provided by Laravel

class RecipeController extends Controller
{
    public function index()
    {
        return view('recipe/index', [
            // Auth::user() gives the logged in user from the session
            'user' => Auth::user(),
        ]);
    }
}

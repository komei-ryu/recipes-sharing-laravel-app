<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; // provided by Laravel

class AuthController extends Controller
{
    public function logout()
    {
        /* logout by destroying the session variable for keeping track of the 
        logged-in user */
        Auth::logout();

        // redirect to login page
        return redirect()->route('login');
    }
}

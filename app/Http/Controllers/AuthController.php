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
        return redirect()->route('auth.loginForm');
    }

    public function loginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        // validate user input
        $request->validate([
            'email' => 'required|max:250',
            'password' => 'required|max:250',
        ]);

        /* Auth::attempt() checks whether there is a user with the following 
        information; if so, return true and log in the user; otherwise, return 
        false. Auth::attempt() will hash the password in the argument so that it 
        can be compared to the hashed password that is stored in the database. */
        $wasLoginSuccessful = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if ($wasLoginSuccessful) {
            return redirect()->route('recipe.index');
        } 
        
        // send flash data using with()
        return redirect()->route('auth.login')->with('error', 'Invalid credentials');
    }
}

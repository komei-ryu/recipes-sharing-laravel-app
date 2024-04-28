<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash; // the Hash class is provided by Laravel
use Auth; // provided by Laravel

class RegistrationController extends Controller
{
    public function index()
    {
        // returns the view of the registration page with the registration form
        return view('registration/index');
    }

    public function register(Request $request)
    {
        // validate user input
        $request->validate([
            'name' => 'required|max:250',
            'email' => 'required|unique:users,email|max:250',
            'password' => 'required|max:250',
        ]);

        // Laravel comes with the User model, which is at app/Models/User.php 
        $user = new User();
        
        // update name column entry in users table
        $user->name = $request->input('name');
        // update email column entry in users table
        $user->email = $request->input('email');
        
        // use Bcrypt to hash the password
        $user->password = Hash::make($request->input('password'));
        
        // running INSERT INTO statement into the database
        $user->save();
        
        // Auth class, login user
        /* Behind the scenes, this creates a session for the user by storing the
        user's id in a session variable, so that when the user visits different 
        pages, the site remembers that the user is logged in. */ 
        Auth::login($user);

        // redirect user to the registration page        
        return redirect()
            ->route('registration.index')
            ->with('success', "Successfully created user for {$request->input('email')}");
    }
}

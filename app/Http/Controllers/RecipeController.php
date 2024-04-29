<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Auth; // provided by Laravel

class RecipeController extends Controller
{
    public function index()
    {
        return view('recipe/index', [
            // Auth::user() gives the logged in user from the session
            'user' => Auth::user(),
            'recipes' => Recipe::with('user')->orderBy('updated_at', 'DESC')->get(),
        ]);
    }

    public function create()
    {
        return view('recipe/create');
    }

    // Laravel injects a Request object to every controller method
    public function store(Request $request)
    {
        // pass an array of validation rules to validate()
        /* If validate() fails, the user will be redirected to the previous
        page, and also automatically generates an error message that we can 
        display to the user. */
        /* If all validations pass, the program will simply move on to the 
        next line of code. */
        $request->validate([
            'title' => 'required|max:99',
            'description' => 'max:100000',
        ]);

        // insert new recipe
        $recipe = new Recipe();
        $recipe->title = $request->input('title');
        $recipe->description = $request->input('description') ? $request->input('description') : '';
        $recipe->user_id = Auth::user()->id;
        $recipe->save();

        // redirect() redirects to a specific page
        /* with() creates flash data (session data) to be passed into 
        recipe.index. The second argument of with() is the value of the 
        'success' session data. */
        return redirect()
            ->route('recipe.index')
            ->with('success', "Successfully created recipe: {$request->input('title')}");
    }

    public function show($recipe_id)
    {
        return view('recipe/show', [
            // with eager loading
            'recipe' => Recipe::with(['user'])->find($recipe_id),
        ]);
    }
}

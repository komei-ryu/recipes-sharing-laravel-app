<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Recipe;
use Auth; // provided by Laravel

class FavoriteController extends Controller
{
    public function index()
    {
        return view('favorite/index');
    }

    // Laravel injects a Request object to every controller method
    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
        ]);

        // insert new favorite row
        $favorite = new Favorite();
        $favorite->recipe_id = $request->input('recipe_id');
        $favorite->favorited_by_user_id = Auth::user()->id;
        $favorite->save();

        $recipe = Recipe::find($request->input('recipe_id'));

        return redirect()
            ->route('favorite.index')
            ->with('success', "Successfully favorited recipe: {$recipe->title}");
    }
}

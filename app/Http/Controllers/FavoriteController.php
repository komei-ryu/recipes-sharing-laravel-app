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
        return view('favorite/index', [
            'favorites' => Favorite::with(['recipe', 'recipe.user'])->where('favorited_by_user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->get(),
        ]);
    }

    // Laravel injects a Request object to every controller method
    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
        ]);

        $recipe = Recipe::find($request->input('recipe_id'));

        // check if the user has already favorited this recipe
        $old_favorite = Favorite::where([
            ['favorited_by_user_id', '=', Auth::user()->id], 
            ['recipe_id', '=', $request->input('recipe_id')],
        ])->get();

        // should not insert new favorite row if such a row already exists
        if(count($old_favorite) > 0) {
            return redirect()
                ->route('recipe.show', $request->input('recipe_id'))
                ->with('error', "Recipe: {$recipe->title} has already been favorited");
        }

        // insert new favorite row
        $favorite = new Favorite();
        $favorite->recipe_id = $request->input('recipe_id');
        $favorite->favorited_by_user_id = Auth::user()->id;
        $favorite->save();

        return redirect()
            ->route('recipe.show', $request->input('recipe_id'))
            ->with('success', "Successfully favorited recipe: {$recipe->title}");
    }
}

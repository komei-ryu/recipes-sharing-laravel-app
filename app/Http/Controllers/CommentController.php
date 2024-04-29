<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Recipe;
use Auth; // provided by Laravel

class CommentController extends Controller
{
    public function create($recipe_id)
    {
        return view('comment/create', [
            'recipe' => Recipe::find($recipe_id),
        ]);
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
            'recipe_id' => 'required|exists:recipes,id',
            'content' => 'required|max:100000',
        ]);

        // insert new comment
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->recipe_id = $request->input('recipe_id');
        $comment->comment_author_user_id = Auth::user()->id;
        $comment->save();

        $recipe = $comment->recipe;

        // redirect() redirects to a specific page
        return redirect()
            ->route('recipe.show', $request->input('recipe_id'))
            ->with('success', "Successfully added comment for recipe: {$recipe->title}");
    }

    public function edit($id)
    {
        return view('comment/edit', [
            'comment' => Comment::with(['recipe'])->find($id),
        ]);
    }

    public function update($id, Request $request)
    {
        // pass an array of validation rules to validate()
        $request->validate([
            'content' => 'required|max:100000',
        ]);

        // update comment
        $comment = Comment::find($id);
        $comment->content = $request->input('content');
        $comment->save();

        $recipe = $comment->recipe;

        // redirect() redirects to a specific page
        return redirect()
            ->route('recipe.show', $recipe->id)
            ->with('success', "Successfully updated comment for recipe: {$recipe->title}");
    }
}

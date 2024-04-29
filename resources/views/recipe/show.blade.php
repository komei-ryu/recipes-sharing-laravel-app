@extends('layout')

@section('title', $recipe->title . 'Details')

@section('main')
    <div class="d-flex justify-content-between me-4">
        <h1 class="mb-3">{{ $recipe->title }}</h1>
        <div class="my-3">
            <form action="{{ route('favorite.store') }}" method="POST">
                @csrf
                <input type="hidden" id="recipe_id" name="recipe_id" value="{{ $recipe->id }}">
                @error('recipe_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <button type="submit" class="btn btn-primary">Add to favorites</button>
            </form>
        </div>
    </div>

    <h3>Description:</h3>
    <p class="ms-1 mt-3 fs-5">{{ $recipe->description }}</p>

    <div class="d-flex justify-content-start me-4 mb-3">
        <h3>Comments:</h3>
        <a href="{{ route('comment.create', $recipe->id) }}">
            <button type="button" class="btn btn-primary ms-5">Add comments</button>
        </a>
    </div>
    @if ($comments && count($comments) > 0)
        @foreach ($comments as $comment)
            <div class="my-3 p-2 fs-5 border rounded">
                <p class="m-1">{{ $comment->content }}</p>
                <p class="m-1">Comment author: {{ $comment->user->name }}</p>
                <p class="m-1">Last updated at: {{ $comment->updated_at }}</p>
                @if ($current_user->id == $comment->comment_author_user_id)
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('comment.edit', $comment->id) }}">
                            <button type="button" class="btn btn-warning m-1">Edit comment</button>
                        </a>
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger m-1 ms-3">Delete comment</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <p class="fs-5">No one has added any comment yet. Be the first one to add a comment!</p>
    @endif
@endsection 

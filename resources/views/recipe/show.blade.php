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
        <button type="button" class="btn btn-primary ms-5">Add comments</button>
    </div>
    @if ($comments && count($comments) > 0)
        @foreach ($comments as $comment)
            <div class="my-3 ms-2 fs-6">
                <p class="m-1">Comment author: {{ $comment->user->name }}</p>
                <p class="m-1">Last updated at: {{ $comment->updated_at }}</p>
                <p class="m-1">{{ $comment->content }}</p>
                @if ($current_user->id == $comment->comment_author_user_id)
                    <p class="mb-2 fw-bold fs-4">
                        <a href="{{ route('comment.edit', $comment->id) }}" class="text-decoration-none">Edit Comment</a>
                    </p>
                @endif
            </div>
        @endforeach
    @else
        <p class="fs-5">No one has added any comment yet. Be the first one to add a comment!</p>
    @endif
@endsection 

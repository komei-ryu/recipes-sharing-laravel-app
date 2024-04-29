@extends('layout')

@section('title', 'My favorites')

@section('main')
    <h1 class="mb-4">My favorites</h1>

    @if ($favorites && count($favorites) > 0)
        @foreach ($favorites as $favorite)
            <div class="my-3 ms-2 fs-6">
                <p class="mb-2 fw-bold fs-4">
                    <a href="{{ route('recipe.show', $favorite->recipe->id) }}" class="text-decoration-none">{{ $favorite->recipe->title }}</a>
                </p>
                <p class="m-1">Author: {{ $favorite->recipe->user->name }}</p>
                <p class="m-1">Favorited at: {{ $favorite->created_at }}</p>
            </div>
        @endforeach
    @else
        <p>No recipe has been favorited by you. Favorite a recipe from a recipe detail page!</p>
    @endif
@endsection 

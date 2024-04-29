@extends('layout')

@section('title', 'My favorites')

@section('main')
    <h1 class="mb-4">My favorites</h1>

    @if ($favorites && count($favorites) > 0)
        @foreach ($favorites as $favorite)
            <div class="my-3 ms-2 fs-6">
                <div class="d-flex justify-content-start">
                    <div class="mb-2 fw-bold fs-4">
                        <a href="{{ route('recipe.show', $favorite->recipe->id) }}" class="text-decoration-none">{{ $favorite->recipe->title }}</a>
                    </div>
                    <div class="ms-5">
                        <form action="{{ route('favorite.destroy', $favorite->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Unfavorite this recipe</button>
                        </form>
                    </div>
                    <!-- <a href="{{ route('favorite.destroy', $favorite->id) }}">
                        <button type="button" class="btn btn-danger ms-5">Unfavorite this recipe</button>
                    </a> -->
                </div>
                <p class="m-1">Author: {{ $favorite->recipe->user->name }}</p>
                <p class="m-1">Favorited at: {{ $favorite->created_at }}</p>
            </div>
        @endforeach
    @else
        <p>No recipe has been favorited by you. Favorite a recipe from a recipe detail page!</p>
    @endif
@endsection 

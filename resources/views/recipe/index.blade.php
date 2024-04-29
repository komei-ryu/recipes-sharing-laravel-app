@extends('layout')

@section('title', 'Home')

@section('main')
    <h1 class="mb-4">Home</h1>

    <p class="fs-3">Hi, {{ $user->name }}! What recipe would you like to check out?</p>

    <a href="{{ route('recipe.create') }}">
        <button type="button" class="btn btn-primary mb-3">Create new recipe</button>
    </a>
    
    @if ($recipes && count($recipes) > 0)
        <div class="mt-3">
            <h3>Recipes:</h3>
        <div>
        @foreach ($recipes as $recipe)
            <div class="my-3 ms-2 fs-6">
                <p class="mb-2 fw-bold fs-4"><a class="text-decoration-none">{{ $recipe->title }}</a></p>
                <p class="m-1">Author: {{ $recipe->user->name }}</p>
                <p class="m-1">Last updated at: {{ $recipe->updated_at }}</p>
            </div>
        @endforeach
    @else
        <p>No recipe has been created by any user. Be the first one to create a recipe!</p>
    @endif
@endsection 

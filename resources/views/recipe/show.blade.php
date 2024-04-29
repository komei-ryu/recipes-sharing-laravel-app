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
@endsection 

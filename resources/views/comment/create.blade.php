@extends('layout')

@section('title', 'New Comment for ' . $recipe->title)

@section('main')
    <h1 class="mt-3 mb-3">New Comment for {{ $recipe->title }}</h1>

    <form action="{{ route('comment.store') }}" method="POST" class="mt-3">
        @csrf

        <input type="hidden" id="recipe_id" name="recipe_id" value="{{ $recipe->id }}">
        @error('recipe_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="mb-3">
            <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection

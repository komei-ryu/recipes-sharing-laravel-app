@extends('layout')

@section('title', 'Edit ' . $recipe->title)

@section('main')
    <h1 class="mt-3 mb-3">Edit Description for {{ $recipe->title }}</h1>

    <form action="{{route('recipe.update', $recipe->id)}}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <textarea name="description" id="description" class="form-control">{{ old('description', $recipe->description) }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection

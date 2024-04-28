@extends('layout')

@section('title', 'Home')

@section('main')
    <h1 class="mb-4">Home</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <p class="fs-3">Hi, {{ $user->name }}! What recipe would you like to check out?</p>
    
    @if ($recipes && count($recipes) > 0)
        @foreach ($recipes as $recipe)
            <p>{{ $recipe->title }} by {{ $recipe->user->name }}</p>
        @endforeach
    @else
        <p>No recipe has been created by any user. Be the first one to create a recipe!</p>
    @endif
@endsection 

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
@endsection 

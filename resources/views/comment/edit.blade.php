@extends('layout')

@section('title', 'Edit Comment for ' . $comment->recipe->title)

@section('main')
    <h1 class="mt-3 mb-3">Edit Comment for {{ $comment->recipe->title }}</h1>

    <form action="{{route('comment.update', $comment->id)}}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <textarea name="content" id="content" class="form-control">{{ old('content', $comment->content) }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection

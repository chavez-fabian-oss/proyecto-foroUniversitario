@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    @foreach($posts as $post)
        <div class="mb-4 p-4 bg-white rounded shadow-sm">
            <h2 class="text-xl font-bold"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
            <p class="text-gray-700">{{ $post->body }}</p>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">By {{ $post->user->name }}</span>
                <div class="flex items-center">
                    <form method="POST" action="{{ route('votes.store') }}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="vote" value="1">
                        <button type="submit" class="mr-2 text-sm text-green-600">Upvote</button>
                    </form>
                    <form method="POST" action="{{ route('votes.store') }}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="vote" value="0">
                        <button type="submit" class="text-sm text-red-600">Downvote</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

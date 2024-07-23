@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="mb-4 p-4 bg-white rounded shadow-sm">
        <h2 class="text-2xl font-bold">{{ $subreddit->name }}</h2>
        <p class="text-gray-700">{{ $subreddit->description }}</p>
        
        @auth
            <div class="flex items-center mt-4">
                <a href="{{ route('posts.create',['subreddit' => $subreddit->id]) }}" class="px-4 py-2 bg-blue-600 text-white rounded mr-2">Crear Post</a>
                @if (!$subreddit->users->contains(auth()->user()))
                    <form method="POST" action="{{ route('subreddits.join', $subreddit) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Unirse</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('subreddits.leave', $subreddit) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Salir</button>
                    </form>
                @endif
            </div>
        @endauth
    </div>

    <h3 class="text-xl font-bold mb-4">Posts</h3>
    @foreach($posts as $post)
        <div class="mb-4 p-4 bg-white rounded shadow-sm">
            <h2 class="text-xl font-bold"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
            <p class="text-gray-700">{{ $post->body }}</p>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Por {{ $post->user->name }} el {{ $post->created_at->format('d M Y') }}</span>
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

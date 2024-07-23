@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="mb-4 p-4 bg-white rounded shadow-sm">
        <h2 class="text-xl font-bold">{{ $post->title }}</h2>
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

    <div class="mb-4 p-4 bg-white rounded shadow-sm">
        <h3 class="text-lg font-bold">Comentarios</h3>
        @foreach($post->comments as $comment)
            <div class="mb-2 p-2 bg-gray-100 rounded">
                <p class="text-gray-700">{{ $comment->body }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">By {{ $comment->user->name }}</span>
                    <div class="flex items-center">
                        <form method="POST" action="{{ route('votes.store') }}">
                            @csrf
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <input type="hidden" name="vote" value="1">
                            <button type="submit" class="mr-2 text-sm text-green-600">Upvote</button>
                        </form>
                        <form method="POST" action="{{ route('votes.store') }}">
                            @csrf
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <input type="hidden" name="vote" value="0">
                            <button type="submit" class="text-sm text-red-600">Downvote</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <div class="mb-4">
                <label for="body" class="block text-gray-700">Añadir comentario</label>
                <textarea name="body" id="body" class="w-full mt-2 border-gray-300 rounded"></textarea>
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Enviar</button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold">Comunidades</h1>
    <a href="{{ route('subreddits.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Crear Comunidad</a>
    @foreach($subreddits as $subreddit)
        <div class="mb-4 p-4 bg-white rounded shadow-sm">
            <h2 class="text-xl font-bold"><a href="{{ route('subreddits.show', $subreddit) }}">{{ $subreddit->name }}</a></h2>
            <p class="text-gray-700">{{ $subreddit->description }}</p>
        </div>
    @endforeach
</div>
@endsection

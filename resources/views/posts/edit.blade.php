@extends('layouts.app')

@section('content')
<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="title" class="sr-only">Título</label>
        <input type="text" name="title" id="title" placeholder="Título" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title', $post->title) }}">
        
        @error('title')
            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-4">
        <label for="body" class="sr-only">Cuerpo</label>
        <textarea name="body" id="body" rows="4" placeholder="Cuerpo" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror">{{ old('body', $post->body) }}</textarea>
        
        @error('body')
            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="subreddit_id" class="sr-only">Comunidad</label>
        <select name="subreddit_id" id="subreddit_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('subreddit_id') border-red-500 @enderror">
            <option value="">Selecciona la Comunidad</option>
            @foreach ($subreddits as $subreddit)
                <option value="{{ $subreddit->id }}" {{ old('subreddit_id', $post->subreddit_id) == $subreddit->id ? 'selected' : '' }}>{{ $subreddit->name }}</option>
            @endforeach
        </select>

        @error('subreddit_id')
            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-4">
        <label for="image" class="sr-only">Imagen</label>
        <input type="file" name="image" id="image" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('image') border-red-500 @enderror">
        
        @error('image')
            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
        @enderror
    </div>
    
    <div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Actualizar Post</button>
    </div>
</form>
@endsection

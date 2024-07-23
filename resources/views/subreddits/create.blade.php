@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <form method="POST" action="{{ route('subreddits.store') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" class="w-full mt-2 border-gray-300 rounded">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Descripcion</label>
            <textarea name="description" id="description" class="w-full mt-2 border-gray-300 rounded"></textarea>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Crear</button>
    </form>
</div>
@endsection

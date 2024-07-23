<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro Universitario</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow mb-4">
        <div class="container mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <div>
                        <a href="{{ url('/') }}" class="flex items-center py-5 px-2 text-gray-700">
                            <span class="font-bold">Foro Universitario</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-1">
                    @auth
                        <span class="text-gray-700 mr-2">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="py-2 px-3 bg-blue-500 text-white rounded">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="py-2 px-3 bg-blue-500 text-white rounded">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="py-2 px-3 bg-green-500 text-white rounded">Registrarse</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container mx-auto px-4 flex">
        <!-- Sidebar -->
        <div class="w-1/4 bg-white shadow p-4 mr-4">
            <h2 class="text-xl font-bold mb-4">Comunidades</h2>
            <ul>
                @foreach ($subreddits as $subreddit)
                    <li class="mb-2">
                        <a href="{{ route('subreddits.show', $subreddit) }}" class="text-blue-500">{{ $subreddit->name }}</a>
                    </li>
                @endforeach
            </ul>
            @auth
                <a href="{{ route('subreddits.create') }}" class="py-2 px-3 bg-blue-500 text-white rounded block text-center mt-4">Crear Comunidad</a>
            @endauth
        </div>
        
        <!-- Main Content -->
        <div class="w-3/4 bg-white shadow p-4">
            <h1 class="text-2xl font-bold mb-4">Bienvenido a Foro Universitario</h1>
            <h2 class="text-xl font-bold mb-4">Últimos Posts</h2>
            @foreach ($posts as $post)
                <div class="mb-4">
                    <h3 class="text-xl font-bold">{{ $post->title }}</h3>
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="mb-4 w-full">
                    @endif
                    <p class="text-gray-700">Publicado por {{ $post->user->name }} el {{ $post->created_at->format('d M Y') }}</p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

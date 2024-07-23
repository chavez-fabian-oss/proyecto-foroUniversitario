<nav class="bg-white border-b border-gray-100">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="text-lg font-semibold">Foro</a>
        </div>
        <div class="flex items-center">
            @guest
                {{--<a href="{{ route('login') }}" class="text-sm text-gray-700">Login</a>
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700">Register</a>--}} 
            @else
                <a href="#" class="text-sm text-gray-700">{{ Auth::user()->name }}</a>
                <form method="POST" action="{{ route('logout') }}" class="ml-4">
                    @csrf
                    <button type="submit" class="text-sm text-gray-700">Cerrar Sesion</button>
                </form>
            @endguest
        </div>
    </div>
</nav>

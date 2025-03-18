<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-[#FFFF00]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full uppercase flex flex-col justify-between">
    <header>
        @auth
        <nav class="flex flex-row items-center gap-2 p-2 bg-white border-2 border-black neo-shadow">
            <a href="{{ route('index') }}" class=" border-2 border-black p-2 text-2xl">Job Board</a>
            <div class="grow"></div>
            @if(Auth::user()->isAdmin)
            <a href="{{ route('users.index') }}" class="p-2 uppercase border-2 border-black bg-pink-500 text-gray-100">Gerenciar Usuarios</a>
            <a href="{{ route('jobs.create') }}" class="p-2 uppercase border-2 border-black bg-pink-500 text-gray-100">Criar Vaga</a>
            @endif
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-2 uppercase border-2 border-black bg-pink-500 text-gray-100 hover:cursor-pointer hover:bg-pink-600 transition-all duration-150 ">Desconectar-se</button>
            </form>
        </nav>
        @endauth
    </header>

    <main class="self-stretch">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Laravel-Simple-Crud. All rights reserved.</p>
    </footer>
</body>
</html>

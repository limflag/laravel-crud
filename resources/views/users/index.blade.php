@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="flex items-center justify-center h-full">
        @if ($errors->any())
        <div class="mb-5 border-2 border-black p-3 gap-3 neo-shadow flex flex-col bg-red-500">
            <h1 class="text-lg font-bold uppercase text-center">Errors!</h1>
            @foreach ($errors->all() as $error)
            <p class="border-2 bg-amber-300 border-black p-2">{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <div id="main-content" class="w-8/12 rounded-lg h-7/12 p-3 flex flex-col gap-3 bg-white border-black border-2 neo-shadow">
            <div class="flex flex-row items-center jusfity-between gap-3">
                <h1 class="text-2xl grow font-bold uppercase">Listagem de usuários</h1>
                <a href="{{ route('users.create') }}" class="neo-shadow p-2 bg-amber-300 border-2 border-black font-bold uppercase text-lg">Criar Usuário</a>
            </div>
            <div class="bg-blue-600 flex flex-col gap-3 p-3 border-2 border-black neo-shadow">
                <form action="" method="GET" class="flex flex-col gap-3">
                    <input type="text" name="search" class="bg-white border-2 border-black p-2 neo-shadow" placeholder="pesquisar usuários" />
                    <div class="flex flex-row gap-3">
                        <label for="role" class="flex flex-col bg-amber-300 border-2 border-black uppercase font-bold p-2 neo-shadow">Tipo de Usuário:
                            <select name="role">
                                <option value="">Todos</option>
                                <option value="1" {{ request('role') == '1' ? 'selected' : '' }}>Administradores</option>
                                <option value="0" {{ request('role') == '0' ? 'selected' : '' }}>Usuários Comuns</option>
                            </select>
                        </label>
                        <button class="bg-green-500 border-2 border-black uppercase font-bold neo-shadow p-2" type="submit">Pesquisar!</button>
                    </div>
                </form>
            @forelse($users as $user)
                <div class="p-2 bg-white border-2 border-black flex flex-row items-center justify-between gap-3">
                    <div class="flex flex-col">
                        <span>ID:</span>
                        <span class=" font-bold uppercase ml-2">{{ $user->id }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span>Nome:</span>
                        <span class=" font-bold uppercase ml-2">{{ $user->name }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span>E-mail:</span>
                        <span class=" font-bold uppercase ml-2">{{ $user->email }}</span>
                    </div>
                    <a href="{{ route('users.show', $user->id) }}" class="border-2 p-2 font-bold  border-black neo-shadow bg-blue-500">Visualizar</a>
                    @if($user->isAdmin)
                    <div class=" font-bold uppercase border-black border-2 bg-amber-300 neo-shadow p-2">ADM</div>
                    @endif
                </div>
            @empty
                <p> sem usuarios para mostrar </p>
            @endforelse
            </div>
            <div>{{ $users->links('vendor.pagination.neob-pagination') }}</div>
        </div>
    </div>
@endsection

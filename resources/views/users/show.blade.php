@extends('layouts.app')

@section('title', 'User Detail')

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
            <form method="POST" action="{{ route('users.update', $user->id) }}" class="flex flex-row">
                @csrf
                @method('PUT')
                <section class="basis-full flex flex-col gap-3 p-3">
                    <label class="flex flex-col">
                        <span class="text-2xl font-bold">Nome:</span>
                        @if(request('editMode'))
                            <input class="p-2 border-2 border-black neo-shadow" type="text" name="name" value="{{ $user->name }}" />
                        @else
                            <p class="border-b-2 border-black text-3xl font-bold">{{ $user->name }}</p>
                        @endif
                    </label>
                    <label class="flex flex-col">
                        <span class="text-2xl font-bold">E-mail:</span>
                        @if(request('editMode'))
                            <input class="p-2 border-2 border-black neo-shadow" type="email" name="email" value="{{ $user->email }}" />
                        @else
                            <p class="border-2 p-2 neo-shadow border-black text-lg font-bold">{{ $user->email }}</p>
                        @endif
                    </label>
                    <label class="flex flex-col">
                        <span class="text-2xl font-bold">Tipo de Conta:</span>
                        @if(request('editMode') && auth()->user()->isAdmin)
                            <select name="isAdmin" class="p-2 border-2 border-black neo-shadow">
                                <option value="0" {{ !$user->isAdmin ? 'selected' : '' }}>Usuário</option>
                                <option value="1" {{ $user->isAdmin ? 'selected' : '' }}>Administrador</option>
                            </select>
                        @else
                            <p class="p-2 border-2 border-black neo-shadow">{{ $user->isAdmin ? "Administrador" : "Usuário" }}</p>
                        @endif
                    </label>
                @if(request('editMode'))
                <a href="{{ route('users.show', $user->id) }}" class="border-2 text-center p-2 bg-red-500 border-black neo-shadow">Cancelar</a>
                <button type="submit" class="border-2 border-black neo-shadow p-2 bg-blue-600 text-gray-100">Salvar Alterações</button>
                @endif
                </section>
            </form>
            @if(!request('editMode'))
            <div class="flex flex-row gap-3">
                <a href="{{ route('users.show', ['id' => $user->id, 'editMode' => true]) }}" class="border-2 text-center p-2 bg-amber-300 border-black neo-shadow">Editar Usuário</a>
                <form action="{{ route('users.delete', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="p-2 border-2 border-black bg-red-600 text-gray-100 font-bold uppercase neo-shadow">Apagar Usuário</button>
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection

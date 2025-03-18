@extends('layouts.app')

@section('title', 'Criar Usuario')

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
        <div class="w-8/12 neo-shadow p-6 bg-white border-2 border-black">
            <h1 class="text-2xl font-bold mb-4">Criar Novo Usuário</h1>
            <form method="POST" action="{{ route('users.store') }}" class="flex flex-col gap-3">
                @csrf
                <label class="block mb-2">
                    <span class="text-lg font-bold">Nome:</span>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full p-2 border-2 border-black neo-shadow">
                </label>
                <label class="block mb-2">
                    <span class="text-lg font-bold">Email:</span>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full p-2 border-2 border-black neo-shadow">
                </label>
                <label class="block mb-2">
                    <span class="text-lg font-bold">Senha:</span>
                    <input type="password" name="password" required
                        class="w-full p-2 border-2 border-black neo-shadow">
                </label>
                <label class="block mb-2">
                    <span class="text-lg font-bold">Confirme a Senha:</span>
                    <input type="password" name="password_confirmation" required
                        class="w-full p-2 border-2 border-black neo-shadow">
                </label>
                <label class="block mb-4">
                    <span class="text-lg font-bold">Administrador?</span>
                    <select name="is_admin" class="w-full p-2 border-2 border-black neo-shadow">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </label>
                <button type="submit" class="w-full bg-blue-600 border-2 uppercase  border-black text-gray-100 p-3 neo-shadow font-bold">
                    Criar Usuário
                </button>
            </form>
        </div>
    </div>
@endsection

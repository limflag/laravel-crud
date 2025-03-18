<!-- resources/views/register.blade.php -->
@extends('layouts.app')

@section('registrar', 'Home Page')

@section('content')
<div class="flex items-center justify-center uppercase font-bold">
        <form action="{{ route('register') }}" method="POST" class="p-3 rounded-lg neo-shadow border-2 border-black bg-white font-bold flex flex-col gap-3">
            @csrf
            <h1 class="text-2xl">Faça seu cadastro</h1>
            <label class="flex flex-col" for="name">Nome:
                <input class="border-2 border-black p-2 neo-shadow focus:outline-0" name="name" type="text" required />
            </label>
            <label class="flex flex-col" for="email">E-Mail:
                <input class="border-2 border-black p-2 neo-shadow focus:outline-0" name="email" type="text" required />
            </label>
            <label class="flex flex-col" for="password">Senha:
                <input class="border-2 border-black p-2 neo-shadow focus:outline-0" name="password" type="password" required />
            </label>
            <label class="flex flex-col" for="password">Confirmar Senha:
                <input class="border-2 border-black p-2 neo-shadow focus:outline-0" name="password_confirmation" type="password" required />
            </label>
            <button class="neo-shadow uppercase p-2 bg-blue-500 border-2 border-black" type="submit">Registrar-se</button>
        </form>
</div>
@endsection

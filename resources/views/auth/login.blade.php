<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('title', 'Login Page')

@section('content')
<div class="font-bold uppercase flex flex-col gap-3 items-center justify-center">
    <h1 class="text-6xl">Bem vindo!</h1>
    <div class="p-3 bg-white rounded-lg border-2 border-black neo-shadow">
        <h2 class="text-center">Insira suas credenciais</h2>
        <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-3 p-3">
            @csrf
            <label class="flex justify-between flex-col" for="email">Login:
                <input class="p-2 neo-shadow rounded bg-white border-2 border-black" required name="email" type="email" placeholder="mail@domain" />
            </label>
            <label class="flex justify-between flex-col" for="password">Senha:
                <input class="p-2 neo-shadow rounded bg-white border-2 border-black" required name="password" type="password" />
            </label>
            <button class="neo-shadow uppercase p-2 border-2 border-black bg-blue-500 active:bg-yellow-400 focus:bg-yellow-400 hover:cursor-pointer" type="submit">Conectar-se</button>
            <a href="{{ route('register') }}" class="hover:text-blue-500 transition-all duration-200">registrar-se</a>
        </form>
    </div>
</div>
@endsection

@section('styles')
    <style>
        /* Your page-specific CSS */
    </style>
@endsection

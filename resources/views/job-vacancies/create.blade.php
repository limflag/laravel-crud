@extends('layouts.app')

@section('title', 'Create')

@section('content')
    <div class="flex flex-col items-center justify-center h-full">
        @if ($errors->any())
        <div class="mb-5 border-2 border-black p-3 gap-3 neo-shadow flex flex-col bg-red-500">
            <h1 class="text-lg font-bold uppercase text-center">Errors!</h1>
            @foreach ($errors->all() as $error)
            <p class="border-2 bg-amber-300 border-black p-2">{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <div class="bg-white w-6/12 p-3 border-black border-2 neo-shadow">
            <form method="POST" action="{{ route('jobs.store') }}" class="flex flex-col gap-3">
                @csrf
                <h1 class="text-2xl font-bold text-center uppercase ">Criar uma nova vaga</h1>
                <label for="title" class="flex flex-col">
                    <span class="text-xl font-bold">Titulo:</span>
                    <input class="border-2 neo-shadow border-black p-2" type="text" name="title" placeholder="Titulo da vaga..." />
                </label>
                <label for="description" class="flex flex-col">
                    <span class="text-xl font-bold">Descrição:</span>
                    <textarea class="border-2 neo-shadow border-black p-2" name="description"></textarea>
                </label>
                <label for="type" class="flex flex-col">
                    <span class="text-xl font-bold">Tipo:</span>
                    <select class="border-2 neo-shadow border-black p-2" name="type">
                        <option default value="CLT">CLT</option>
                        <option value="CNPJ">CNPJ</option>
                        <option value="Freelancer">Freelancer</option>
                    </select>
                </label>
                <label for="paused" class="flex flex-col">
                    <span class="text-xl font-bold">Ativa:</span>
                    <select class="border-2 neo-shadow border-black p-2" name="paused">
                        <option default value="0">Ativa</option>
                        <option value="1">Pausada</option>
                    </select>
                </label>
                <button type="submit" class="cursor-pointer border-2 border-black neo-shadow uppercase font-bold bg-blue-600 text-gray-100 p-2">Criar vaga</button>
            </form>
        </div>
    </div>
@endsection

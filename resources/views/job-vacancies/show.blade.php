@extends('layouts.app')

@section('title', 'Detail')

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
        <div id="main-content" class="w-8/12 rounded-lg h-7/12 p-3 bg-white border-black border-2 neo-shadow">
            <form method="POST" action="{{ route('jobs.update', $job->id) }}" class="flex flex-row">
                @csrf
                @method('PUT')
                <section class="{{ Auth::user()->isAdmin ? 'basis-10/12' : 'basis-full' }} flex flex-col gap-3 p-3">
                    <label class="flex flex-col">
                        <span class="text-2xl font-bold">Titulo:</span>
                        @if(request('editMode'))
                        <input class="p-2 border-2 border-black neo-shadow" type="text" name="title" value="{{ $job->title }}" />
                        @else
                        <p class="border-b-2 border-black text-3xl font-bold">{{ $job->title}}</p>
                        @endif
                    </label>
                    <label class="flex flex-col">
                        <span class="text-2xl font-bold">Descrição:</span>
                        @if(request('editMode'))
                        <textarea name="description" class="p-2 border-2 border-black neo-shadow">{{ $job->description }}</textarea>
                        @else
                        <p class="border-2 p-2 neo-shadow border-black text-lg font-bold">{{ $job->description }}</p>
                        @endif
                    </label>
                    <label class="flex flex-col">
                        <span class="text-2xl font-bold">Tipo de contratação:</span>
                        @if(request('editMode'))
                        <select name="type" class="p-2 border-2 border-black neo-shadow">
                            <option {{ $job->type == 'CLT' ? 'selected' : '' }} value="{{ 'CLT' }}">CLT</option>
                            <option {{ $job->type == 'CNPJ' ? 'selected' : '' }} value="{{ 'CNPJ' }}">CNPJ</option>
                            <option {{ $job->type == 'Freelancer' ? 'selected' : '' }} value="Freelancer">Freelancer</option>
                        </select>
                        @else
                        <p class="border-2 p-2 neo-shadow border-black text-lg font-bold">{{ $job->type }}</p>
                        @endif
                    </label>
                    <label class="flex flex-col">
                        <span class="text-2xl font-bold">Status:</span>
                        @if(request('editMode'))
                        <select name="paused" class="p-2 border-2 border-black neo-shadow">
                            <option value="0" {{ !$job->paused ? 'selected' : '' }}>Ativa</option>
                            <option value="1" {{ $job->paused ? 'selected' : '' }}>Inativa</option>
                        </select>
                        @else
                        <p class="p-2 border-2 border-black neo-shadow">{{ $job->paused ? "Inativa" : "Ativa" }}</p>
                        @endif
                    </label>
                </section>
                @if(Auth::user()->isAdmin)
                <aside class="flex flex-col border-l-2 gap-3 border-black p-3">
                    <div class="border-b-2 border-black text-2xl font-bold uppercase">Administração</div>
                    @if(!request('editMode'))
                    <a href="{{ route('jobs.show', ['id' => $job->id, 'editMode' => true]) }}" class="border-2 font-bold text-center p-2 bg-amber-300 border-black neo-shadow">Editar Vaga</a>
                    <form method="POST" action="{{ route('jobs.destroy', $job->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-2 cursor-pointer border-black neo-shadow font-bold uppercase text-center p-2 bg-red-500">Apagar Vaga</button>
                    </form>
                    @else
                    <a href="{{ route('jobs.show', $job->id) }}" class="border-2 font-bold text-center p-2 bg-red-500 border-black neo-shadow">Cancelar</a>
                    @endif
                    @if(request('editMode'))
                    <button type="submit" class="border-2 font-bold border-black neo-shadow p-2 bg-blue-600 text-gray-100">Enviar alterações</button>
                    @endif
                </aside>
                @endif
            </form>
            @if(!request('editMode') && !$job->paused)
            <div class="p-3">
                <form method="POST" action="{{ route('jobs.apply', $job->id) }}">
                    @csrf
                    @if(!auth()->user() || !$job->applications->contains('user_id', auth()->id()))
                    <button type="submit" class="bg-blue-600 border-2 border-black p-2 cursor-pointer neo-shadow text-gray-100 font-bold uppercase">Inscrever-se</button>
                    @else
                    <button type="submit" class="bg-red-600 border-2 border-black p-2 cursor-pointer neo-shadow text-gray-100 font-bold uppercase">Cancelar inscrição</button>
                    @endif
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection

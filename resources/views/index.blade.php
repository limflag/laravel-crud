@extends('layouts.app')

@section('title', 'Home Page')

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
        <div id="main-content" class="w-10/12 rounded-lg h-7/12 flex flex-col items-stretch gap-3 p-3 bg-white border-black border-2 neo-shadow">
            <form method="GET" action="{{ route('index') }}" class="flex flex-col gap-3">
                <div class="p-3">
                    <input class="p-2 w-full bg-white neo-shadow border-2 border-black" placeholder="Pesquise vagas..." type="text" name="search" value="{{ request('search') }}" />
                </div>
                <div class="flex flex-row gap-3 px-3 pb-3">
                    <label class="flex flex-col bg-amber-300 border-2 border-black neo-shadow p-2" for="order_by">Ordernar por:
                        <select name="order_by" class="border-t-2 p-2 border-black">
                            <option {{ request('order_by') == 'created_at' ? 'selected' : ''}} value="created_at">Criação</option>
                            <option {{ request('order_by') == 'id' ? 'selected' : ''}} value="id" >ID</option>
                            <option {{ request('order_by') == 'title' ? 'selected' : ''}} value="title" >Titulo</option>
                            <option {{ request('order_by') == 'description' ? 'selected' : ''}} value="description">Descrição</option>
                            <option {{ request('order_by') == 'type' ? 'selected' : ''}} value="type" >Tipo</option>
                            <option {{ request('order_by') == 'paused' ? 'selected' : ''}} value="paused">Status</option>
                        </select>
                    </label>
                    <label class="flex flex-col bg-amber-300 border-2 border-black neo-shadow p-2" for="order-dir">Direção:
                        <select name="order_dir" class="border-t-2 p-2 border-black">
                            <option {{ request('order_dir') == 'desc' ? 'selected' : '' }} value="desc" default>Desc</option>
                            <option {{ request('order_dir') == 'asc' ? 'selected' : '' }} value="asc" >Asc</option>
                        </select>
                    </label>
                    <label class="flex flex-col bg-amber-300 border-2 border-black neo-shadow p-2" for="type">Tipo de vaga:
                        <select name="type" class="border-t-2 p-2 border-black">
                            <option value="" default>Todas</option>
                            <option {{ request('type') == 'CLT' ? 'selected' : ''}} value="CLT">CLT</option>
                            <option {{ request('type') == 'CNPJ' ? 'selected' : ''}} value="CNPJ">CNPJ</option>
                            <option {{ request('type') == 'Freelancer' ? 'selected' : ''}} value="Freelancer" >Freelancer</option>
                        </select>
                    </label>
                    <label class="flex flex-col bg-amber-300 border-2 border-black neo-shadow p-2" for="paused">Status vaga:
                        <select name="paused" class="border-t-2 p-2 border-black">
                            <option value="" default>Todas</option>
                            <option {{ request('paused') == '0' ? 'selected' : ''}} value="0" >Ativas</option>
                            <option {{ request('paused') == '1' ? 'selected' : ''}} value="1" >Pausadas</option>
                        </select>
                    </label>
                    <label class="flex flex-col bg-amber-300 border-2 border-black neo-shadow p-2" for="applied">Visualizar:
                        <select name="applied" class="border-t-2 p-2 border-black">
                            <option default>Todas</option>
                            <option {{ request('applied') == 'inscritas' ? 'selected' : ''}} value="inscritas">Inscritas</option>
                            <option {{ request('applied') == 'nao_inscritas' ? 'selected' : ''}} value="nao_inscritas">Não inscritas</option>
                        </select>
                    </label>
                    <div class="grow"></div>
                    <button type="submit" class="justify-self-end border-2 border-black p-2 uppercase font-bold bg-blue-600 text-gray-100 neo-shadow duration-100 transition-all hover:bg-blue-700">Pesquisar</button>
                </div>
            </form>
            <div class="text-gray-100 bg-blue-600 flex flex-wrap flex-row rounded-lg border-2 border-black h-96 overflow-y-auto items-start justify-start">
                @forelse($jobVacancies as $jobVacancie)
                <div id="vaga-card__container" class="p-2 basis-3/12 relative">
                    <div id="vaga-card" class="text-gray-800 text-sm relative h-full p-3 flex flex-col gap-3 rounded-lg border-2 border-black neo-shadow {{ $jobVacancie->paused == 1 ? 'bg-red-200' : 'bg-white' }}">
                        <div id="vaga-card__description" class="text-ellipsis border-b-2 border-black line-clamp-1 font-bold">{{ $jobVacancie->title }}</div>
                        <div id="vaga-card__description" class="relative max-w-xs h-[5rem] overflow-hidden text-ellipsis line-clamp-4">
                            {{ $jobVacancie->description }}
                        </div>
                        <div id="vaga-card__actions" class="flex flex-row items-center justify-between gap-3">
                            <a href="{{ route('jobs.show', $jobVacancie->id) }}" class="border-2 border-black p-2 transition-all duration-150 {{ $jobVacancie->paused ? 'bg-gray-300 ' : 'bg-amber-300 hover:bg-pink-500 neo-shadow '}}" {{ $jobVacancie->paused ? 'disabled' : ''}}>Detalhes</a>
                            <div class="border-2 border-black text-xs p-2">{{ $jobVacancie->type }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <div>Nenhuma vaga encontrada!</div>
                @endforelse
            </div>
            <div>{{ $jobVacancies->links('vendor.pagination.neob-pagination') }}</div>
        </div>
    </div>
@endsection

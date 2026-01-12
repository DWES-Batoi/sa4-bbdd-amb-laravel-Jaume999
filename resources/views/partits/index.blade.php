@extends('layouts.app')
@section('title', 'Calendari de Partits')

@section('content')
<div class="container">
    <h1 class="title">Calendari i Resultats</h1>
    
    <div class="grid-cards">
        @foreach ($partits as $partit)
            <article class="card">
                <header class="card__header">
                    <span class="card__badge">Jornada {{ $partit->jornada }}</span>
                    <span class="text-sm">{{ \Carbon\Carbon::parse($partit->data)->format('d/m H:i') }}</span>
                </header>

                <div class="card__body text-center">
                    <div class="flex justify-between items-center gap-2">
                        <span class="font-bold w-1/3">{{ $partit->local->nom }}</span>
                        <span class="bg-gray-800 text-white px-2 py-1 rounded text-lg">
                            {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
                        </span>
                        <span class="font-bold w-1/3">{{ $partit->visitant->nom }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Estadi: {{ $partit->estadi->nom }}</p>
                </div>

                <footer class="card__footer justify-center">
                    <a class="btn btn--ghost" href="{{ route('partits.edit', $partit) }}">Editar Resultat</a>
                </footer>
            </article>
        @endforeach
    </div>
</div>
@endsection

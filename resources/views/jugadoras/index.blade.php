@extends('layouts.equip')
@section('title', 'Llistat de Jugadores')

@section('content')
<div class="container">
    <h1 class="title">Guia de Jugadores</h1>
    <p class="mb-4">
        <a href="{{ route('jugadoras.create') }}" class="btn btn--primary">Afegir Jugadora</a>
    </p>

    <div class="grid-cards">
        @foreach ($jugadoras as $jugadora)
            <article class="card">
                <header class="card__header">
                    <h2 class="card__title">{{ $jugadora->nom }}</h2>
                    <span class="card__badge">Dorsal: {{ $jugadora->dorsal }}</span>
                </header>

                <div class="card__body">
                    <p><strong>Equip:</strong> {{ $jugadora->equip->nom }}</p>
                    <p><strong>Edat:</strong> {{ \Carbon\Carbon::parse($jugadora->data_naixement)->age }} anys</p>
                </div>

                <footer class="card__footer">
                    <a class="btn btn--ghost" href="{{ route('jugadoras.show', $jugadora) }}">Fitxa</a>
                    <form method="POST" action="{{ route('jugadoras.destroy', $jugadora) }}" class="inline">
                        @csrf @method('DELETE')
                        <button class="btn btn--danger" type="submit">Eliminar</button>
                    </form>
                </footer>
            </article>
        @endforeach
    </div>
</div>
@endsection


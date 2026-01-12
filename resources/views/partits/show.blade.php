@extends('layouts.app')

@section('title', "Detall del Partit")

@section('content')
    <div class="mb-6">
        <a href="{{ route('partits.index') }}" class="text-blue-600 hover:underline">← Tornar al calendari</a>
    </div>

    <x-partit 
        :local="$partit->local->nom"
        :visitant="$partit->visitant->nom"
        :estadi="$partit->estadi->nom"
        :data="$partit->data"
        :jornada="$partit->jornada"
        :golsLocal="$partit->gols_local"
        :golsVisitant="$partit->gols_visitant"
    />
@endsection

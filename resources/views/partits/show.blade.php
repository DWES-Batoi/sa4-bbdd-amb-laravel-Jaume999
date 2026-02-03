@extends('layouts.equip')

@section('title', __("Detall del Partit"))

@section('content')
    <div class="container mx-auto p-8">
        <div class="mb-6">
            <a href="{{ route('partits.index') }}" class="text-blue-600 hover:underline flex items-center">
                <span class="mr-1">←</span> {{ __('Tornar al calendari') }}
            </a>
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
    </div>
@endsection
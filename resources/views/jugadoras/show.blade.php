@extends('layouts.equip')

@section('title', "Perfil de " . $jugadora->nom)

@section('content')
    <div class="container mx-auto">
        <div class="mb-6">
            <a href="{{ route('jugadoras.index') }}" class="text-blue-600 hover:underline">
                ← Tornar al llistat de jugadores
            </a>
        </div>

        <x-jugadora 
            :id="$jugadora->id"
            :nom="$jugadora->nom"
            :equip="$jugadora->equip->nom"
            :dataNaixement="$jugadora->data_naixement"
            :dorsal="$jugadora->dorsal"
            :foto="$jugadora->foto"
        />
    </div>
@endsection

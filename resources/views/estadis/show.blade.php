@extends('layouts.equip')
{{-- Usamos comillas dobles para que la comilla simple de d'Estadi no rompa el código --}}
@section('title', __("Detall d'Estadi"))

@section('content')
  <div class="container mx-auto px-4 py-8">
      <x-estadi
        :nom="$estadi->nom"
        :capacitat="$estadi->capacitat"
        :equips="$estadi->equips"
      />

      <h3>Descripció (IA local)</h3>

      @if(!empty($descripcio))
        <p>{{ $descripcio }}</p>
      @else
        <p><em>No s’ha pogut generar la descripció ara mateix.</em></p>
      @endif
      
      {{-- Botón para volver atrás --}}
      <div class="mt-6" >
          <a href="{{ route('estadis.index') }}" class="text-blue-800 hover:underline flex items-center gap-2">
              {{ __('Tornar al llistat') }}
          </a>
      </div>
  </div>
@endsection
@extends('layouts.equip')
{{-- Traducimos el título de la pestaña --}}
@section('title', __("Detall d'Equip"))

@section('content')
  {{-- El componente x-equip debería gestionar sus propias traducciones dentro de su archivo --}}
  <x-equip
    :equip="$equip"
  />

  <div class="mt-8 bg-white p-6 rounded-xl shadow-md">
    {{-- Título de la sección traducido --}}
    <h3 class="text-xl font-bold mb-4 text-blue-800">{{ __("Últims 5 partits") }}</h3>
    
    <div class="space-y-3">
        @forelse($equip->ultimsPartits() as $partit)
            <div class="flex justify-between items-center border-b pb-2">
                {{-- Formato de fecha (Carbon lo detecta bien) --}}
                <span class="text-sm text-black">
                    {{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}
                </span>
                
                <div class="flex-1 text-center font-semibold text-black">
                    {{ $partit->local->nom }} 
                    <span class="bg-gray-200 px-2 rounded text-black">
                        {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
                    </span> 
                    {{ $partit->visitant->nom }}
                </div>
            </div>
        @empty
            {{-- Mensaje de lista vacía traducido --}}
            <p class="text-black italic">
                {{ __("No hi ha partits registrats encara.") }}
            </p>
        @endforelse
    </div>
</div>
@endsection
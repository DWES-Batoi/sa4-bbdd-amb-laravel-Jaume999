@extends('layouts.app')
@section('title', "Detall d'Equip")

@section('content')
  <x-equip
    :equip="$equip"
  />
  <div class="mt-8 bg-white p-6 rounded-xl shadow-md">
    <h3 class="text-xl font-bold mb-4 text-blue-800">Últims 5 partits</h3>
    <div class="space-y-3">
        @forelse($equip->ultimsPartits() as $partit)
            <div class="flex justify-between items-center border-b pb-2">
                <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}</span>
                <div class="flex-1 text-center font-semibold">
                    {{ $partit->local->nom }} 
                    <span class="bg-gray-100 px-2 rounded">{{ $partit->gols_local }} - {{ $partit->gols_visitant }}</span> 
                    {{ $partit->visitant->nom }}
                </div>
            </div>
        @empty
            <p class="text-gray-500 italic">No hi ha partits registrats encara.</p>
        @endforelse
    </div>
</div>
@endsection

@extends('layouts.equip')
@section('title', __('Editar equip'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-blue-800">{{ __('Editar equip') }}</h1>

    <form action="{{ route('equips.update', $equip) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-xl shadow-md border border-gray-100">
        @csrf
        @method('PUT')

        <!-- Campo Nombre -->
        <div>
            <label class="block text-sm font-bold text-black mb-1">{{ __('Nom') }}</label>
            <input type="text" name="nom" value="{{ old('nom', $equip->nom) }}" 
                   class="w-full border border-gray-300 rounded-lg p-2.5 text-black focus:ring-blue-500 focus:border-blue-500 @error('nom') border-red-500 @enderror">
            @error('nom') <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Campo Estadio -->
        <div>
            <label class="block text-sm font-bold text-black mb-1">{{ __('Estadi') }}</label>
            <select name="estadi_id" class="w-full border border-gray-300 rounded-lg p-2.5 text-black focus:ring-blue-500 focus:border-blue-500">
                @foreach($estadis as $estadi)
                    <option value="{{ $estadi->id }}" @selected(old('estadi_id', $equip->estadi_id) == $estadi->id)>
                        {{ $estadi->nom }}
                    </option>
                @endforeach
            </select>
            @error('estadi_id') <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Campo Títulos -->
        <div>
            <label class="block text-sm font-bold text-black mb-1">{{ __('Titols') }}</label>
            <input type="number" name="titols" value="{{ old('titols', $equip->titols) }}" 
                   class="w-full border border-gray-300 rounded-lg p-2.5 text-black focus:ring-blue-500 focus:border-blue-500">
            @error('titols') <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Escudo Actual -->
        @if($equip->escut)
            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <img src="{{ asset('storage/' . $equip->escut) }}" class="h-16 w-16 object-contain rounded-md border bg-white" alt="Escut">
                <div>
                    <p class="text-sm font-bold text-black">{{ __('Escut actual') }}</p>
                    <p class="text-xs text-gray-500">{{ $equip->escut }}</p>
                </div>
            </div>
        @endif

        <!-- Input de Archivo (Estilizado para evitar texto de navegador) -->
        <div>
            <label class="block text-sm font-bold text-black mb-1">{{ __('Nou escut (opcional)') }}</label>
            <input type="file" name="escut" 
                   class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-md file:border-0
                          file:text-sm file:font-semibold
                          file:bg-blue-600 file:text-white
                          hover:file:bg-blue-700 transition">
            @error('escut') <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Botón de Guardar -->
        <div class="pt-4">
            <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-md transition duration-300">
                {{ __('Desar') }}
            </button>
        </div>
    </form>
</div>
@endsection
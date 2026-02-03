@extends('layouts.equip')
@section('title', __('Nou Equip'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-blue-800">{{ __('Nou Equip') }}</h1>

    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-4 mb-6 rounded-lg shadow-sm border border-red-200">
        <p class="font-bold mb-2">{{ __('Corregeix els següents errors:') }}</p>
        <ul class="list-disc ml-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('equips.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-xl shadow-md border border-gray-100" enctype="multipart/form-data">
        @csrf

        <!-- Campo Nombre -->
        <div>
            <label for="nom" class="block text-sm font-bold text-black mb-1">{{ __('Nom') }}</label>
            <input
                type="text"
                name="nom"
                id="nom"
                value="{{ old('nom') }}"
                placeholder="{{ __('Nom del equip') }}"
                class="w-full border border-gray-300 rounded-lg p-2.5 text-black focus:ring-blue-500 focus:border-blue-500 @error('nom') border-red-500 @enderror"
            >
            @error('nom') <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Campo Estadio -->
        <div>
            <label for="estadi_id" class="block text-sm font-bold text-black mb-1">{{ __('Estadi') }}</label>
            <select name="estadi_id" id="estadi_id" class="w-full border border-gray-300 rounded-lg p-2.5 text-black focus:ring-blue-500 focus:border-blue-500">
                @foreach ($estadis as $estadi)
                    <option value="{{ $estadi->id }}" {{ old('estadi_id') == $estadi->id ? 'selected' : '' }}>
                        {{ $estadi->nom }}
                    </option>
                @endforeach
            </select>
            @error('estadi_id') <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Campo Títulos -->
        <div>
            <label for="titols" class="block text-sm font-bold text-black mb-1">{{ __('Titols') }}</label>
            <input
                type="number"
                name="titols"
                id="titols"
                value="{{ old('titols') }}"
                placeholder="0"
                class="w-full border border-gray-300 rounded-lg p-2.5 text-black focus:ring-blue-500 focus:border-blue-500"
            >
            @error('titols') <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Campo Escudo (Estilizado) -->
        <div>
            <label for="escut" class="block text-sm font-bold text-black mb-1">{{ __('Escut') }}</label>
            <input type="file" name="escut" id="escut"
                class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                       file:mr-4 file:py-2 file:px-4
                       file:rounded-md file:border-0
                       file:text-sm file:font-semibold
                       file:bg-blue-600 file:text-white
                       hover:file:bg-blue-700 transition">
            @error('escut')
                <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botón de Envío -->
        <div class="pt-4">
            <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-md transition duration-300">
                {{ __('Afegir') }}
            </button>
        </div>
    </form>
</div>
@endsection
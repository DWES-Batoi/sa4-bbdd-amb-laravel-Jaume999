@extends('layouts.equip')
@section('title', __('Nou Estadi'))

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Título en negro y traducido --}}
    <h1 class="text-2xl font-bold mb-6 text-blue-800">{{ __('Nou Estadi') }}</h1>

    {{-- Bloque de errores traducido --}}
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

    <form action="{{ route('estadis.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-xl shadow-md border border-gray-100">
        @csrf

        {{-- Campo Nombre --}}
        <div>
            <label for="nom" class="block text-sm font-bold text-black mb-1">{{ __('Nom') }}</label>
            <input
                type="text"
                name="nom"
                id="nom"
                value="{{ old('nom') }}"
                class="w-full border border-gray-300 rounded-lg p-2.5 text-black focus:ring-blue-500 focus:border-blue-500 @error('nom') border-red-500 @enderror"
                placeholder="{{ __('Ex: Camp Nou') }}"
            >
            @error('nom')
                <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Campo Capacidad --}}
        <div>
            <label for="capacitat" class="block text-sm font-bold text-black mb-1">{{ __('Capacitat') }}</label>
            <input
                type="number" 
                name="capacitat"
                id="capacitat"
                value="{{ old('capacitat') }}"
                class="w-full border border-gray-300 rounded-lg p-2.5 text-black focus:ring-blue-500 focus:border-blue-500 @error('capacitat') border-red-500 @enderror"
                placeholder="Ex: 99000"
            >
            @error('capacitat')
                <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botón de envío traducido --}}
        <div class="pt-2">
            <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md transition duration-300">
                {{ __('Afegir Estadi') }}
            </button>
        </div>
    </form>
</div>
@endsection
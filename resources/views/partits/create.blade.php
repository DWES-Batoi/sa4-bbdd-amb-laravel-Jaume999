@extends('layouts.equip')
@section('title', __('Programar Partit'))

@section('content')
<div class="container mx-auto max-w-2xl p-8">
    <div class="mb-6">
        <a href="{{ route('partits.index') }}" class="text-blue-600 hover:underline flex items-center">
            ← {{ __('Tornar al calendari') }}
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-6 text-blue-800">{{ __('Programar nou partit') }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow-sm">
            <p class="font-bold">{{ __('Corregeix els següents errors:') }}</p>
            <ul class="list-disc ml-5 mt-1">
                @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li> 
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('partits.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-md space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-bold text-gray-700 mb-1">{{ __('Equip Local') }}:</label>
                <select name="local_id" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500 text-black">
                    <option value="" disabled selected>{{ __('Selecciona equip') }}</option>
                    @foreach($equips as $e) 
                        <option value="{{$e->id}}" {{ old('local_id') == $e->id ? 'selected' : '' }}>{{$e->nom}}</option> 
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-bold text-gray-700 mb-1">{{ __('Equip Visitant') }}:</label>
                <select name="visitant_id" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500 text-black">
                    <option value="" disabled selected>{{ __('Selecciona equip') }}</option>
                    @foreach($equips as $e) 
                        <option value="{{$e->id}}" {{ old('visitant_id') == $e->id ? 'selected' : '' }}>{{$e->nom}}</option> 
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block font-bold text-gray-700 mb-1">{{ __('Estadi') }}:</label>
            <select name="estadi_id" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500 text-black">
                <option value="" disabled selected>{{ __('Selecciona un estadi') }}</option>
                @foreach($estadis as $est) 
                    <option value="{{$est->id}}" {{ old('estadi_id') == $est->id ? 'selected' : '' }}>{{$est->nom}}</option> 
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-bold text-gray-700 mb-1">{{ __('Data i Hora') }}:</label>
                <input type="datetime-local" name="data" value="{{ old('data') }}" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500 text-black">
            </div>
            <div>
                <label class="block font-bold text-gray-700 mb-1">{{ __('Jornada') }}:</label>
                <input type="number" name="jornada" value="{{ old('jornada') }}" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500 text-black">
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-800 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition shadow-md">
                {{ __('Crear Partit') }}
            </button>
        </div>
    </form>
</div>
@endsection
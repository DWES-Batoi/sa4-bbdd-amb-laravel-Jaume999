@extends('layouts.equip')
@section('title', __('Nova Jugadora'))

@section('content')
<div class="container mx-auto max-w-2xl p-8">
    <div class="mb-6">
        <a href="{{ route('jugadoras.index') }}" class="text-blue-600 hover:underline flex items-center">
            ← {{ __('Tornar al llistat') }}
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-6 text-blue-800">{{ __('Inscriure nova jugadora') }}</h1>

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

    <form action="{{ route('jugadoras.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-xl shadow-md space-y-6">
        @csrf
        <div>
            <label class="block font-bold text-gray-700 mb-1">{{ __('Nom') }}:</label>
            <input type="text" name="nom" value="{{ old('nom') }}" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500 text-black">
        </div>

        <div>
            <label class="block font-bold text-gray-700 mb-1">{{ __('Equip') }}:</label>
            <select name="equip_id" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500 text-black">
                <option value="" disabled selected>{{ __('Selecciona un equip') }}</option>
                @foreach ($equips as $equip)
                    <option value="{{ $equip->id }}" {{ old('equip_id') == $equip->id ? 'selected' : '' }}>
                        {{ $equip->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-4">
            <div class="w-1/2">
                <label class="block font-bold text-gray-700 mb-1">{{ __('Data Naixement') }}:</label>
                <input type="date" name="data_naixement" value="{{ old('data_naixement') }}" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500 text-black">
            </div>
            <div class="w-1/2">
                <label class="block font-bold text-gray-700 mb-1">{{ __('Dorsal') }}:</label>
                <input type="number" name="dorsal" value="{{ old('dorsal') }}" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500 text-black">
            </div>
        </div>

        <div>
            <label class="block font-bold text-gray-700 mb-1">{{ __('Foto (PNG)') }}:</label>
            <input type="file" name="foto" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500 text-black">
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-blue-800 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition shadow-md">
                {{ __('Registrar Jugadora') }}
            </button>
        </div>
    </form>
</div>
@endsection
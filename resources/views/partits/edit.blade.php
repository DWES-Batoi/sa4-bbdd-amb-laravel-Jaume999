@extends('layouts.equip')
@section('title', 'Editar Partit')

@section('content')
<div class="container mx-auto max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('partits.index') }}" class="text-blue-600 hover:underline">← Tornar al calendari</a>
    </div>

    <h1 class="text-2xl font-bold mb-6 text-blue-800">Editar Partit / Resultat</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('partits.update', $partit) }}" method="POST" class="bg-white p-8 rounded-xl shadow-md space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-bold text-gray-700 mb-1">Equip Local:</label>
                <select name="local_id" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500">
                    @foreach ($equips as $equip)
                        <option value="{{ $equip->id }}" {{ old('local_id', $partit->local_id) == $equip->id ? 'selected' : '' }}>
                            {{ $equip->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-bold text-gray-700 mb-1">Equip Visitant:</label>
                <select name="visitant_id" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500">
                    @foreach ($equips as $equip)
                        <option value="{{ $equip->id }}" {{ old('visitant_id', $partit->visitant_id) == $equip->id ? 'selected' : '' }}>
                            {{ $equip->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg">
            <p class="font-bold text-center text-gray-700 mb-3">Resultat del Partit</p>
            <div class="flex items-center justify-center gap-8">
                <div class="text-center">
                    <label class="block text-xs uppercase font-bold text-gray-500">Gols Local</label>
                    <input type="number" name="gols_local" value="{{ old('gols_local', $partit->gols_local) }}" class="border p-2 w-20 text-center text-2xl font-bold rounded">
                </div>
                <div class="text-3xl font-bold text-gray-300">-</div>
                <div class="text-center">
                    <label class="block text-xs uppercase font-bold text-gray-500">Gols Visitant</label>
                    <input type="number" name="gols_visitant" value="{{ old('gols_visitant', $partit->gols_visitant) }}" class="border p-2 w-20 text-center text-2xl font-bold rounded">
                </div>
            </div>
        </div>

        <div>
            <label class="block font-bold text-gray-700 mb-1">Estadi:</label>
            <select name="estadi_id" class="border p-2 w-full rounded">
                @foreach ($estadis as $estadi)
                    <option value="{{ $estadi->id }}" {{ old('estadi_id', $partit->estadi_id) == $estadi->id ? 'selected' : '' }}>
                        {{ $estadi->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-bold text-gray-700 mb-1">Data i Hora:</label>
                <input type="datetime-local" name="data" value="{{ old('data', \Carbon\Carbon::parse($partit->data)->format('Y-m-d\TH:i')) }}" class="border p-2 w-full rounded">
            </div>

            <div>
                <label class="block font-bold text-gray-700 mb-1">Jornada:</label>
                <input type="number" name="jornada" value="{{ old('jornada', $partit->jornada) }}" class="border p-2 w-full rounded">
            </div>
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="btn btn--primary flex-1 py-3 text-center">Actualitzar Partit</button>
            <a href="{{ route('partits.index') }}" class="btn btn--ghost py-3 text-center">Cancel·lar</a>
        </div>
    </form>
</div>
@endsection

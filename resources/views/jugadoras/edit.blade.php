@extends('layouts.app')
@section('title', 'Editar Jugadora: ' . $jugadora->nom)

@section('content')
<div class="container mx-auto max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('jugadoras.index') }}" class="text-blue-600 hover:underline">← Tornar al llistat</a>
    </div>

    <h1 class="text-2xl font-bold mb-6 text-blue-800">Editar Perfil: {{ $jugadora->nom }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jugadoras.update', $jugadora) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-xl shadow-md space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="nom" class="block font-bold text-gray-700 mb-1">Nom complet:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $jugadora->nom) }}" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="equip_id" class="block font-bold text-gray-700 mb-1">Equip:</label>
                <select name="equip_id" id="equip_id" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500">
                    @foreach ($equips as $equip)
                        <option value="{{ $equip->id }}" {{ old('equip_id', $jugadora->equip_id) == $equip->id ? 'selected' : '' }}>
                            {{ $equip->nom }}
                        </option>
                    @endforeach
                                    </select>
            </div>

            <div>
                <label for="dorsal" class="block font-bold text-gray-700 mb-1">Dorsal:</label>
                <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal', $jugadora->dorsal) }}" class="border p-2 w-full rounded">
            </div>
        </div>

        <div>
            <label for="data_naixement" class="block font-bold text-gray-700 mb-1">Data de Naixement:</label>
            <input type="date" name="data_naixement" id="data_naixement" value="{{ old('data_naixement', $jugadora->data_naixement) }}" class="border p-2 w-full rounded">
        </div>

        <div>
            <label for="foto" class="block font-bold text-gray-700 mb-1">Foto (opcional):</label>
            <input type="file" name="foto" id="foto" class="border p-2 w-full rounded">
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700">
                Actualitzar dades
            </button>
            <a href="{{ route('jugadoras.index') }}" class="bg-gray-200 px-6 py-2 rounded-lg font-bold">
                Cancel·lar
            </a>
        </div>
    </form>
</div>
@endsection

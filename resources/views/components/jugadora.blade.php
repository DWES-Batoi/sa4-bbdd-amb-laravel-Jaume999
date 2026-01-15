@props([
    'id',
    'nom',
    'equip',
    'dataNaixement',
    'dorsal',
    'foto' => null
])

@php
    $edat = \Carbon\Carbon::parse($dataNaixement)->age;
@endphp

<div class="max-w-md mx-auto bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
    <div class="bg-blue-800 p-4 text-center">
        <!-- Espacio para la foto -->
        @if($foto)
            <img class="w-32 h-32 rounded-full mx-auto border-4 border-white object-cover" 
                 src="{{ asset('storage/' . $foto) }}" alt="{{ $nom }}">
        @else
            <!-- Imagen por defecto si no hay foto -->
            <div class="w-32 h-32 rounded-full mx-auto border-4 border-white bg-gray-300 flex items-center justify-center">
                <span class="text-4xl text-gray-500 font-bold">{{ substr($nom, 0, 1) }}</span>
            </div>
        @endif
        <h2 class="text-2xl font-bold text-white mt-2">{{ $nom }}</h2>
        <span class="inline-block bg-yellow-400 text-blue-900 px-3 py-1 rounded-full text-sm font-bold">
            Dorsal {{ $dorsal }}
        </span>
    </div>

    <div class="p-6 space-y-4">
        <div class="flex justify-between border-b pb-2">
            <span class="text-gray-500">Equip:</span>
            <span class="font-bold text-blue-800">{{ $equip }}</span>
        </div>
        <div class="flex justify-between border-b pb-2">
            <span class="text-gray-500">Edat:</span>
            <span class="font-bold">{{ $edat }} anys</span>
        </div>
        <div class="flex justify-between border-b pb-2">
            <span class="text-gray-500">Data Naixement:</span>
            <span class="font-bold">{{ \Carbon\Carbon::parse($dataNaixement)->format('d/m/Y') }}</span>
        </div>
    </div>

    <div class="bg-gray-50 p-4 text-center">
        <a href="{{ route('jugadoras.edit', $id) }}" class="text-blue-600 font-semibold hover:underline">
            Editar perfil
        </a>
    </div>
</div>

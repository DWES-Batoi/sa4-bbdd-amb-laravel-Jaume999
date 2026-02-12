@extends('layouts.equip')
@section('title', __('Llistat de Jugadores'))

@section('content')
<div class="min-h-screen bg-[#1a202c] p-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white font-sans text-blue-800">{{ __('Llistat de Jugadores') }}</h1>
            <a href="{{ route('jugadoras.create') }}" 
               class="bg-[#2d9d5f] hover:bg-[#258551] text-white font-bold py-2 px-6 rounded-lg flex items-center transition shadow-lg">
                <span class="mr-2 text-xl">+</span> {{ __('Afegir Jugadora') }}
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($jugadoras as $jugadora)
                <article class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100 flex flex-col transform hover:scale-105 transition duration-300">
                    <div class="relative h-56 bg-blue-900 overflow-hidden">
                        @if($jugadora->foto)
                            <img src="{{ asset('storage/' . $jugadora->foto) }}" alt="{{ $jugadora->nom }}" class="w-full h-full object-cover object-top">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-b from-blue-700 to-blue-900">
                                <span class="text-white text-8xl font-black opacity-20">{{ $jugadora->dorsal }}</span>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="bg-blue-600 text-white text-sm font-black px-3 py-1 rounded-lg shadow-md border border-blue-400">
                                {{ $jugadora->dorsal }}
                            </span>
                        </div>
                    </div>

                    <div class="p-5 flex-grow">
                        <h2 class="text-xl font-bold text-gray-800 mb-1 truncate">{{ $jugadora->nom }}</h2>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold">{{ __('Equip') }}</p>
                            <p class="text-blue-700 font-bold text-sm">{{ $jugadora->equip->nom }}</p>
                            <div class="flex justify-between items-end mt-4">
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold">{{ __('Edat') }}</p>
                                    <p class="text-gray-800 font-bold text-sm">{{ \Carbon\Carbon::parse($jugadora->data_naixement)->age }} {{ __('anys') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 grid grid-cols-3 gap-2 border-t border-gray-100">
                        <a href="{{ route('jugadoras.show', $jugadora) }}" class="text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 rounded-lg text-xs transition">{{ __('Veure') }}</a>
                        <a href="{{ route('jugadoras.edit', $jugadora) }}" class="text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg text-xs transition">{{ __('Editar') }}</a>
                        <form method="POST" action="{{ route('jugadoras.destroy', $jugadora) }}" onsubmit="return confirm('{{ __('Segur que vols eliminar esta jugadora?') }}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 rounded-lg text-xs transition">{{ __('Eliminar') }}</button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</div>
@endsection
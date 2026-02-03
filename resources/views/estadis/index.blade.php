@extends('layouts.equip')
@section('title', __("Guia d'Estadis"))

@section('content')
<div class="container mx-auto px-4 py-8 text-black">
    
    <!-- Cabecera con Título y Botón -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-blue-800">{{ __("Guia d'Estadis") }}</h1>
        
        @auth
        <a href="{{ route('estadis.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            {{ __('Nou Estadi') }}
        </a>
        @endauth
    </div>

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-200 text-green-800 p-4 mb-6 rounded-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Rejilla de Estadios (Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($estadis as $estadi)
            <article class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 flex flex-col">
                <div class="p-6 flex-grow">
                    <div class="flex items-center gap-3 mb-4">
                        <!-- Icono de estadio -->
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-black">{{ $estadi->nom }}</h2>
                    </div>

                    <p class="text-black">
                        <span class="font-bold">{{ __('Capacitat') }}:</span> 
                        {{ number_format($estadi->capacitat, 0, ',', '.') }} {{ __('espectadors') }}
                    </p>
                </div>

                <footer class="p-5 bg-gray-50 border-t border-gray-100 flex gap-2">
                    <a class="flex-1 text-center px-3 py-2 bg-gray-200 text-black rounded-lg hover:bg-gray-300 transition" 
                       href="{{ route('estadis.show', $estadi->id) }}"> {{ __('Veure') }} </a>
                    
                    @auth
                    <a class="flex-1 text-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" 
                       href="{{ route('estadis.edit', $estadi->id) }}"> {{ __('Editar') }} </a>

                    <form method="POST" action="{{ route('estadis.destroy', $estadi->id) }}" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button class="w-full px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition" 
                                onclick="return confirm('{{ __('¿Seguro que quieres eliminar este estadio?') }}')"
                                type="submit"> {{ __('Eliminar') }} </button>
                    </form>
                    @endauth
                </footer>
            </article>
        @endforeach
    </div>
</div>
@endsection
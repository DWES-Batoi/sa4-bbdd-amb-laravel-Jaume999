@extends('layouts.equip')
@section('title', __("Guia d'Equips"))

@section('content')
<div class="container mx-auto px-4 py-8 text-black">
    
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-blue-800">{{ __("Guia d'Equips") }}</h1>
        
        @auth
        <a href="{{ route('equips.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            {{ __('Nou Equip') }}
        </a>
        @endauth
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($equips as $equip)
            <article class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 flex flex-col">
                <header class="p-5 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-xl font-bold">{{ $equip->nom }}</h2>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mt-1">
                        {{ __('Titols') }}: {{ $equip->titols }}
                    </span>
                </header>

                <div class="p-5 flex-grow">
                    <ul class="space-y-2">
                        <li><strong>{{ __('Estadi') }}:</strong> {{ $equip->estadi->nom ?? '—' }}</li>
                        <li><strong>{{ __('Jugadores') }}:</strong> {{ $equip->jugadoras->count() }}</li>
                        <li><strong>{{ __('Edat Mitjana') }}:</strong> {{ $equip->edadMedia() }} {{ __('anys') }}</li>
                    </ul>
                </div>

                <footer class="p-5 bg-gray-50 border-t border-gray-100 flex gap-2">
                    <a class="flex-1 text-center px-3 py-2 bg-gray-200 rounded-lg" 
                       href="{{ route('equips.show', $equip) }}"> {{ __('Veure') }} </a>
                    
                    @auth
                    <a class="flex-1 text-center px-3 py-2 bg-blue-600 text-white rounded-lg" 
                       href="{{ route('equips.edit', $equip) }}"> {{ __('Editar') }} </a>

                    <form method="POST" action="{{ route('equips.destroy', $equip) }}" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button class="w-full px-3 py-2 bg-red-600 text-white rounded-lg" 
                                onclick="return confirm('{{ __('Segur que vols eliminar aquest equipo?') }}')"
                                type="submit"> {{ __('Eliminar') }} </button>
                    </form>
                    @endauth
                </footer>
            </article>
        @endforeach
    </div>
</div>
@endsection
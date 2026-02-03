@extends('layouts.equip')
@section('title', __('Calendari de Partits'))

@section('content')
<div class="min-h-screen bg-[#1a202c] p-8 font-sans">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-black text-white tracking-tight">{{ __('Calendari i Resultats') }}</h1>
                <p class="text-gray-400 mt-1 italic">{{ __('Temporada') }} 2025/26</p>
            </div>
            
            @auth
            <a href="{{ route('partits.create') }}" 
               class="bg-[#2d9d5f] hover:bg-[#258551] text-white font-bold py-2.5 px-6 rounded-xl flex items-center transition-all shadow-lg hover:shadow-green-500/20">
                <span class="mr-2 text-xl font-light">+</span> {{ __('Nou Partit') }}
            </a>
            @endauth
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ($partits as $partit)
                <article class="bg-white rounded-2xl shadow-xl border border-gray-100 flex flex-col transform hover:scale-[1.01] transition duration-300 overflow-hidden">
                    
                    <div class="bg-gray-50 px-6 py-3 border-b flex justify-between items-center">
                        <span class="bg-blue-100 text-blue-700 text-xs font-black px-3 py-1 rounded-full uppercase tracking-widest">
                            {{ __('Jornada') }} {{ $partit->jornada }}
                        </span>
                        <div class="flex items-center text-gray-500 text-xs font-bold uppercase tracking-tighter">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($partit->data)->translatedFormat('d/m/Y - H:i') }}
                        </div>
                    </div>

                    <div class="p-8 flex items-center justify-between gap-4">
                        <div class="flex-1 text-center">
                            <h2 class="text-lg font-black text-gray-800 uppercase tracking-tight break-words h-14 flex items-center justify-center">
                                {{ $partit->local->nom }}
                            </h2>
                            <p class="text-[10px] text-blue-500 font-black mt-2 tracking-widest uppercase">{{ __('LOCAL') }}</p>
                        </div>

                        <div class="flex flex-col items-center">
                            <div class="flex items-center bg-gray-900 rounded-xl px-4 py-3 shadow-inner ring-4 ring-gray-100">
                                <span class="text-3xl font-black text-white w-10 text-center leading-none">
                                    {{ $partit->gols_local ?? '-' }}
                                </span>
                                <span class="mx-2 text-gray-500 font-bold text-xl">:</span>
                                <span class="text-3xl font-black text-white w-10 text-center leading-none">
                                    {{ $partit->gols_visitant ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex-1 text-center">
                            <h2 class="text-lg font-black text-gray-800 uppercase tracking-tight break-words h-14 flex items-center justify-center">
                                {{ $partit->visitant->nom }}
                            </h2>
                            <p class="text-[10px] text-red-500 font-black mt-2 tracking-widest uppercase">{{ __('VISITANT') }}</p>
                        </div>
                    </div>

                    <div class="px-8 pb-6 text-center">
                        <div class="inline-flex items-center text-gray-400 text-sm font-medium">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ __('Estadi') }} {{ $partit->estadi->nom }}
                        </div>
                    </div>

                    @auth
                    <div class="bg-gray-50 px-6 py-4 flex gap-3 border-t border-gray-100">
                        <a href="{{ route('partits.show', $partit) }}" 
                           class="flex-1 text-center bg-white border border-gray-200 hover:bg-gray-100 text-gray-700 font-black py-2.5 rounded-lg text-[10px] tracking-widest transition uppercase">
                            {{ __('Detalls') }}
                        </a>
                        <a href="{{ route('partits.edit', $partit) }}" 
                           class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white font-black py-2.5 rounded-lg text-[10px] tracking-widest transition uppercase shadow-md">
                            {{ __('Editar') }}
                        </a>
                        <form method="POST" action="{{ route('partits.destroy', $partit) }}" class="flex-1" onsubmit="return confirm('{{ __('Segur que vols eliminar aquest partit?') }}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-black py-2.5 rounded-lg text-[10px] tracking-widest transition uppercase shadow-md">
                                {{ __('Borrar') }}
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                        <a href="{{ route('partits.show', $partit) }}" 
                           class="block w-full text-center bg-gray-800 text-white font-black py-2.5 rounded-lg text-[10px] tracking-widest transition uppercase">
                            {{ __('Veure Fitxa Completa') }}
                        </a>
                    </div>
                    @endauth
                </article>
            @endforeach
        </div>
    </div>
</div>
@endsection
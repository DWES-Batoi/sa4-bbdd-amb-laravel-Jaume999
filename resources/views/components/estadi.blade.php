@props(['nom', 'capacitat', 'equips'])

<div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 text-black">
    <div class="flex items-center gap-4 mb-6">
        <div class="bg-blue-100 p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold">{{ $nom }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Información básica -->
        <div>
            <h2 class="text-lg font-semibold border-b pb-2 mb-4">{{ __('Informació') }}</h2>
            <p class="text-xl">
                <span class="font-bold">{{ __('Capacitat') }}:</span> 
                {{ number_format($capacitat, 0, ',', '.') }} {{ __('espectadors') }}
            </p>
        </div>

        <!-- Equipos que juegan aquí -->
        <div>
            <h2 class="text-lg font-semibold border-b pb-2 mb-4">{{ __('Equips que hi juguen') }}</h2>
            @if($equips->count() > 0)
                <ul class="list-disc ml-5 space-y-1">
                    @foreach($equips as $equip)
                        <li>
                            <a href="{{ route('equips.show', $equip) }}" class="hover:text-blue-600 transition">
                                {{ $equip->nom }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="italic text-gray-500">{{ __('Aquest estadi no té equips assignats.') }}</p>
            @endif
        </div>
    </div>
</div>
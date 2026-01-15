@props([
    'local',
    'visitant',
    'estadi',
    'data',
    'jornada',
    'golsLocal' => 0,
    'golsVisitant' => 0
])

<div class="border rounded-xl shadow-lg p-6 bg-white max-w-2xl mx-auto">
    <div class="text-center mb-4">
        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
            Jornada {{ $jornada }}
        </span>
        <p class="text-gray-500 text-sm mt-1">
            {{ \Carbon\Carbon::parse($data)->format('d/m/Y - H:i') }}
        </p>
    </div>

    <div class="flex items-center justify-between gap-4">
        <!-- Equipo Local -->
        <div class="flex flex-col items-center w-1/3">
            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center text-xl font-bold">
                {{ substr($local, 0, 1) }}
            </div>
            <h3 class="text-lg font-bold text-center">{{ $local }}</h3>
        </div>

        <!-- Marcador -->
        <div class="flex items-center gap-4 text-4xl font-black text-gray-800">
            <span>{{ $golsLocal }}</span>
            <span class="text-gray-300">-</span>
            <span>{{ $golsVisitant }}</span>
        </div>

        <!-- Equipo Visitante -->
        <div class="flex flex-col items-center w-1/3">
            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center text-xl font-bold">
                {{ substr($visitant, 0, 1) }}
            </div>
            <h3 class="text-lg font-bold text-center">{{ $visitant }}</h3>
        </div>
    </div>

    <div class="mt-6 pt-4 border-t border-gray-100 text-center">
        <p class="text-gray-600">
            <span class="font-semibold">Estadi:</span> {{ $estadi }}
        </p>
    </div>
</div>

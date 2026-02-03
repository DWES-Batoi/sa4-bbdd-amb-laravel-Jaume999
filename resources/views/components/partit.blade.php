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
            {{ __('Jornada') }} {{ $jornada }}
        </span>
        <p class="text-gray-500 text-sm mt-1">
            {{ \Carbon\Carbon::parse($data)->translatedFormat('d/m/Y - H:i') }}
        </p>
    </div>

    <div class="flex items-center justify-between gap-4">
        <div class="flex flex-col items-center w-1/3">
            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center text-xl font-bold">
                {{ substr($local, 0, 1) }}
            </div>
            <h3 class="text-lg font-bold text-center text-black">{{ $local }}</h3>
            <p class="text-[10px] text-blue-500 font-black uppercase tracking-widest">{{ __('LOCAL') }}</p>
        </div>

        <div class="flex items-center gap-4 text-4xl font-black text-gray-800">
            <span>{{ $golsLocal ?? 0 }}</span>
            <span class="text-gray-300">-</span>
            <span>{{ $golsVisitant ?? 0 }}</span>
        </div>

        <div class="flex flex-col items-center w-1/3">
            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center text-xl font-bold">
                {{ substr($visitant, 0, 1) }}
            </div>
            <h3 class="text-lg font-bold text-center text-black">{{ $visitant }}</h3>
            <p class="text-[10px] text-red-500 font-black uppercase tracking-widest">{{ __('VISITANT') }}</p>
        </div>
    </div>

    <div class="mt-6 pt-4 border-t border-gray-100 text-center">
        <p class="text-gray-600">
            <span class="font-semibold">{{ __('Estadi') }}:</span> {{ $estadi }}
        </p>
    </div>
</div>
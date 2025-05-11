@props([
    'titulo' => 'Atenção',
    'texto' => '',
    'tipo' => 'info',       // success, error, warning, info
    'mostra' => true,
    'autoClose' => false,   // ex: true
    'tempo' => 4000         // tempo em ms
])

@php
    $cores = [
        'success' => 'bg-green-100 text-green-800 border-green-300',
        'error'   => 'bg-red-100 text-red-800 border-red-300',
        'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
        'info'    => 'bg-blue-100 text-blue-800 border-blue-300',
    ];

    $icones = [
        'success' => '<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>',
        'error'   => '<svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>',
        'warning' => '<svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" /></svg>',
        'info'    => '<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" /></svg>',
    ];

    $classes = $cores[$tipo] ?? $cores['info'];
    $icone = $icones[$tipo] ?? $icones['info'];
@endphp

@if ($mostra)
    <div 
        x-data="{ mostrar: true }"
        x-init="@if($autoClose) setTimeout(() => mostrar = false, {{ $tempo }}); @endif"
        x-show="mostrar"
        x-transition
        class="flex items-start border-l-4 p-4 rounded shadow-sm {{ $classes }}"
    >
        <div class="mr-3">{!! $icone !!}</div>
        <div>
            <h3 class="font-bold text-sm mb-1">{{ $titulo }}</h3>
            <p class="text-sm">{{ $texto }}</p>
        </div>
    </div>
@endif

@props(['titulo', 'icone' => 'chart-bar', 'cor' => 'blue'])

<div class="bg-white shadow-md border-l-4 border-{{ $cor }}-600 rounded p-4">
    <div class="flex items-center gap-2 text-{{ $cor }}-600 mb-3">
        <x-icon :name="$icone" class="w-6 h-6" />
        <h2 class="text-lg font-semibold">{{ $titulo }}</h2>
    </div>
    <ul class="space-y-2">
        {{ $slot }}
    </ul>
</div>

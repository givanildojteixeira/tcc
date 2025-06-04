@props(['titulo', 'icone' => 'document', 'cor' => 'blue'])

<div class="bg-white shadow-md rounded-md p-4 border-l-4 border-b-4 border-{{ $cor }}-500">
    <!-- Título com ícone -->
    <div class="flex items-center gap-2 text-{{ $cor }}-600 font-semibold mb-2">
        <x-icon :name="$icone" class="w-5 h-5" />
        <h2 class="text-lg">{{ $titulo }}</h2>
    </div>

    <!-- Lista de itens -->
    <ul class="space-y-1">
        {{ $slot }}
    </ul>
</div>

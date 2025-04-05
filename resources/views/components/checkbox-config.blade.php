@props(['chave', 'label'])

@php
    $valor = config_sistema($chave, 'false') === 'true';
@endphp

<div class="flex items-center gap-3">
    <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox"
            id="{{ $chave }}"
            {{ $valor ? 'checked' : '' }}
            onchange="salvarConfiguracao('{{ $chave }}', this.checked)"
            class="sr-only peer">

        <!-- Trilha do botão -->
        <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-500 transition-all duration-300"></div>

        <!-- Bolinha deslizante -->
        <div
            class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow-md transform peer-checked:translate-x-5 transition-transform duration-300">
        </div>
    </label>

    <span class="text-sm text-gray-700 font-medium">{{ $label }}</span>
</div>


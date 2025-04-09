@props(['name', 'label' => '', 'value' => 0])

@php
    $raw = old($name, $value ?? 0);

    // Remove caracteres indesejados (R$, espaço, ponto, vírgula etc.)
    $limpo = preg_replace('/[^0-9.]/', '', str_replace(',', '.', $raw));

    // Converte e garante número positivo
    $numero = is_numeric($limpo) ? max(0, (float) $limpo) : 0;

    $formatado = number_format($numero, 2, ',', '.');
    $id = $attributes->get('id', $name);
@endphp

<div class="flex flex-col flex-1">
    @if ($label)
        <label for="{{ $id }}" class="block text-gray-700 font-medium mb-1">
            {{ $label }}
        </label>
    @endif

    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="text"
        inputmode="decimal"
        value="{{ $formatado }}"
        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none text-right"
    >
</div>

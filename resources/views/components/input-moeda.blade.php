@props(['name', 'label', 'value'])

@php
    $valorFormatado = number_format(old($name, $value ?? 0), 2, ',', '.');
    $id = $attributes->get('id', $name);
@endphp

<div class="w-full">
    <label class="block text-gray-700 font-medium mb-1">{{ $label }}</label>
    <input type="text" name="{{ $name }}" id="{{ $id }}"
        value="{{ $valorFormatado }}"
        {{ $attributes->merge(['class' => 'w-full text-right border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm']) }}>
</div>

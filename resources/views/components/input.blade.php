@props(['label', 'name', 'type' => 'text'])

<div class="flex flex-col">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}
        class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 w-full" />
</div>

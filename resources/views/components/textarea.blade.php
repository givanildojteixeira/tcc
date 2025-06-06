@props(['label', 'name', 'rows' => 3])

<div class="flex flex-col">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif
    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}" {{ $attributes }}
        class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 w-full resize-none"></textarea>
</div>

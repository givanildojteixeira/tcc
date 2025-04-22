@props(['name', 'checked' => false])

<input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="1"
    @if($checked) checked @endif
    {{ $attributes }}
    class="rounded border-gray-300 text-green-600 shadow-sm focus:ring focus:ring-green-500">

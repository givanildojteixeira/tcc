@props(['texto', 'rota', 'icone' => 'document'])

<li>
    <a href="{{ route($rota) }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 transition">
        <x-icon :name="$icone" class="w-5 h-5" />
        <span>{{ $texto }}</span>
    </a>
</li>

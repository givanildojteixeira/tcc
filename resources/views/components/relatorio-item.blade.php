@props(['texto', 'rota', 'icone' => 'document', 'usaDatas' => false])

<li x-data>
    @if ($usaDatas)
        <button 
            @click="$dispatch('abrir-modal-relatorio', { rota: '{{ route($rota) }}' })"
            class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 transition w-full text-left"
        >
            <x-icon :name="$icone" class="w-5 h-5" />
            <span>{{ $texto }}</span>
        </button>
    @else
        <a href="{{ route($rota) }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 transition">
            <x-icon :name="$icone" class="w-5 h-5" />
            <span>{{ $texto }}</span>
        </a>
    @endif
</li>

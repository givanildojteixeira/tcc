<div class="space-y-2">
    <div class="grid grid-cols-2 font-semibold text-gray-600 border-b pb-1">
        <div>Descrição</div>
        <div>Site</div>
    </div>

    @forelse ($familias as $f)
        <div class="grid grid-cols-2 border-b py-1 text-sm text-gray-800">
            <div>{{ $f->descricao }}</div>
            <div>{{ $f->site ?? '-' }}</div>
        </div>
    @empty
        <p class="text-center text-gray-500 py-4">Nenhuma família cadastrada.</p>
    @endforelse
</div>

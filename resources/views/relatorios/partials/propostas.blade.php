<div class="space-y-2">
    {{-- Cabeçalho --}}
    <div class="grid font-semibold text-gray-600 border-b pb-1"
         style="grid-template-columns: 60px 180px 1fr 120px 140px;">
        <div>Nº</div>
        <div>Vendedor</div>
        <div>Veículo</div>
        <div class="text-right">Proposta</div>
        <div class="text-right">Negociações</div>
    </div>

    {{-- Linhas --}}
    @forelse ($propostas as $p)
        <div class="grid py-1 text-sm text-gray-800"
             style="grid-template-columns: 60px 180px 1fr 120px 140px;">
            <div>#{{ $p->id }}</div>
            <div>{{ $p->vendedor->name ?? '-' }}</div>
            <div>{{ $p->veiculo->desc_veiculo ?? '-' }}</div>
            <div class="text-right">R$ {{ number_format($p->veiculo->vlr_nota, 2, ',', '.') }}</div>
            <div class="text-right">
                R$ {{ number_format($p->negociacoes->sum('valor'), 2, ',', '.') }}
            </div>
        </div>
    @empty
        <p class="text-gray-500 py-4">Nenhuma proposta aprovada encontrada.</p>
    @endforelse
</div>

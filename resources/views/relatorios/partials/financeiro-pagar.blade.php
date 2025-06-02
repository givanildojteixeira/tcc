<div class="space-y-2">
    <div class="grid grid-cols-5 font-semibold text-gray-600 border-b pb-1">
        <div>Proposta</div>
        <div>Cliente</div>
        <div>Chassi</div>
        <div class="text-right">Valor</div>
        <div class="text-right">Status</div>
    </div>

    @forelse ($propostas as $p)
        <div class="grid grid-cols-5 border-b py-1 text-sm text-gray-800">
            <div>#{{ $p->id }}</div>
            <div>{{ $p->nome ?? '-' }}</div>
            <div>{{ $p->chassi ?? '-' }}</div>
            <div class="text-right">R$ {{ number_format($p->veiculo->vlr_tabela ?? 0, 2, ',', '.') }}</div>
            <div class="text-right">
                @if ($p->pago)
                    <span class="text-green-600 font-semibold">Pago</span>
                @else
                    <span class="text-red-600 font-semibold">Em aberto</span>
                @endif
            </div>
        </div>
    @empty
        <p class="text-gray-500 py-4">Nenhuma proposta encontrada no período informado.</p>
    @endforelse
</div>

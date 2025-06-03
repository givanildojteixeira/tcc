<div class="space-y-2">
    <div class="grid grid-cols-9 font-semibold text-gray-600 border-b pb-1">
        <div>Status</div>
        <div>Proposta</div>
        <div>Cliente</div>
        <div>Veículo</div>
        <div>Chassi</div>
        <div>Motivo</div>
        <div>Faturamento</div>
        <div>Vencimento</div>
        <div class="text-right">Valor</div>
    </div>

    @forelse ($negociacoes as $p)
        <div class="grid grid-cols-9 border-b py-1 text-sm text-gray-800">
            @if ($p->pago)
                <span class="text-green-600 font-semibold">Recebido</span>
            @else
                <span class="text-red-600 font-semibold">Em aberto</span>
            @endif
            <div>#{{ $p->proposta_id }}</div>
            <div>{{ $p->cliente_nome ?? '-' }}</div>
            <div>{{ $p->desc_veiculo ?? '-' }}</div>
            <div>{{ $p->chassi ? substr($p->chassi, -6) : '-' }}</div>
            <div>{{ $p->condicao_pagamento ?? '-' }}</div>
            <div>
                {{ optional($p->dta_faturamento) ? \Carbon\Carbon::parse($p->dta_faturamento)->format('d/m/Y') : '-' }}
            </div>
            <div>
                {{ optional($p->data_vencimento) ? \Carbon\Carbon::parse($p->data_vencimento)->format('d/m/Y') : '-' }}
            </div>
            <div class="text-right">R$ {{ number_format($p->valor ?? 0, 2, ',', '.') }}</div>
        </div>
    @empty
        <p class="text-gray-500 py-4">Nenhuma proposta encontrada no período informado.</p>
    @endforelse
</div>

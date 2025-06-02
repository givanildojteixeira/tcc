<div class="space-y-2">
    {{-- Cabeçalho da lista --}}
    <div class="grid grid-cols-4 font-semibold text-gray-600 border-b pb-1">
        <div>Modelo</div>
        <div>Ano</div>
        <div>Chassi</div>
        <div class="text-right">Valor</div>
    </div>

    {{-- Lista de veículos --}}
    @forelse ($veiculos as $v)
        <div class="grid grid-cols-4  py-1 text-sm text-gray-800">
            <div>{{ $v->desc_veiculo }}</div>
            <div>{{ $v->Ano_Mod }}</div>
            <div>{{ $v->chassi }}</div>
            <div class="text-right">R$ {{ number_format($v->vlr_tabela, 2, ',', '.') }}</div>
        </div>
    @empty
        <p class="text-gray-500 py-4">Nenhum veículo encontrado.</p>
    @endforelse
</div>

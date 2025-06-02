<table class="w-full text-sm border border-collapse">
    <thead class="bg-gray-100 text-gray-800">
        <tr>
            <th class="border px-2 py-1">Modelo</th>
            <th class="border px-2 py-1">Ano</th>
            <th class="border px-2 py-1">Chassi</th>
            <th class="border px-2 py-1">Vendedor</th>
            <th class="border px-2 py-1">Data Venda</th>
            <th class="border px-2 py-1 text-right">Valor</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($veiculos as $v)
            <tr>
                <td class="border px-2 py-1">{{ $v->desc_veiculo }}</td>
                <td class="border px-2 py-1">{{ $v->Ano_Mod }}</td>
                <td class="border px-2 py-1">{{ $v->chassi }}</td>
                <td class="border px-2 py-1">{{ $v->proposta->vendedor->name ?? '-' }}</td>
                <td class="border px-2 py-1">
                    {{ optional($v->proposta)->dta_faturamento ? \Carbon\Carbon::parse($v->proposta->dta_faturamento)->format('d/m/Y') : '-' }}
                </td>



                <td class="border px-2 py-1 text-right">R$ {{ number_format($v->vlr_tabela, 2, ',', '.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-gray-500 py-4">Nenhum veículo encontrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>

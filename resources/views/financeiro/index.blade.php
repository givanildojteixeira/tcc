<x-app-layout>
    <div class="max-w-7xl mx-auto p-4">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Financeiro - A Pagar</h2>

        <!-- Campo de Pesquisa -->
        <form method="GET" action="{{ route('financeiro.index') }}" class="mb-4">
            <input type="text" name="search" placeholder="Buscar proposta, cliente ou chassi"
                value="{{ $search }}" class="px-3 py-2 border rounded w-1/2">
            <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Buscar</button>
        </form>

        <table class="min-w-full bg-white border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2">Tipo</th>
                    <th class="px-3 py-2">Proposta</th>
                    <th class="px-3 py-2">Cliente</th>
                    <th class="px-3 py-2">Chassi</th>
                    <th class="px-3 py-2">Veículo</th>
                    <th class="px-3 py-2">Faturamento</th>
                    <th class="px-3 py-2">Vencimento</th>
                    <th class="px-3 py-2">Valor</th>
                    <th class="px-3 py-2">Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse($propostas as $proposta)
                    <tr class="border-t">
                        <td class="px-3 py-2 text-red-600 font-bold">Pagar</td>
                        <td class="px-3 py-2">{{ $proposta->id }}</td>
                        <td class="px-3 py-2">{{ $proposta->nome_cliente }}</td>
                        <td class="px-3 py-2">{{ $proposta->veiculo->chassi ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $proposta->veiculo->desc_veiculo ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $proposta->dta_faturamento ?? '-' }}</td>
                        <td class="px-3 py-2">
                            {{ $proposta->dta_faturamento ? \Carbon\Carbon::parse($proposta->dta_faturamento)->addDays(10)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-3 py-2 text-right">
                            R$ {{ number_format($proposta->vlr_nota, 2, ',', '.') }}
                        </td>
                        <td class="px-3 py-2 text-center">
                            <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Pagar</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center py-4 text-gray-500">Nenhuma proposta encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>


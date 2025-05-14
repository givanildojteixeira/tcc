<x-app-layout>
    <div x-data="{
        showModal: false,
        editModal: false,
        editData: {
            id: null,
            id_cliente: '',
            id_veiculoNovo: '',
            id_veiculoUsado1: '',
            id_usuario: '',
            data_proposta: '',
            status: '',
            observacao_nota: '',
            observacao_interna: ''
        }
    }">
        <!-- Cabeçalho -->
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 px-4 py-4 bg-white shadow rounded-md border">
            <h2 class="text-2xl font-semibold text-green-700">Gerenciar Propostas</h2>

            <!-- Filtro -->
            <form method="GET" action="{{ route('propostas.index') }}"
                class="flex gap-2 w-full flex-wrap md:col-span-2">

                <select name="status" class="border px-3 py-2 rounded-md w-60 shrink-0">
                    <option value="">Status (todos)</option>
                    <option value="pendente" {{ request('status')=='pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="aprovada" {{ request('status')=='aprovada' ? 'selected' : '' }}>Aprovada</option>
                    <option value="faturada" {{ request('status')=='faturada' ? 'selected' : '' }}>Faturada</option>
                    <option value="rejeitada" {{ request('status')=='rejeitada' ? 'selected' : '' }}>Rejeitada</option>
                    <option value="cancelada" {{ request('status')=='cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>

                <input type="text" name="busca" value="{{ request('busca') }}"
                    placeholder="Buscar por cliente ou veículo"
                    class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />

                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition flex items-center gap-1">
                    <i class="fas fa-search"></i> Buscar
                </button>

                @if (request('busca'))
                <a href="{{ route('propostas.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition flex items-center gap-1">
                    <i class="fas fa-broom"></i> Limpar
                </a>
                @endif
            </form>



            <!-- Botão Novo -->
            <div class="text-right">
                <a href="{{ route('propostas.limparECreate', ['aba' => 'veiculo']) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                    + Nova Proposta
                </a>
            </div>
        </div>

        <!-- Tabela de propostas -->
        <div class="w-full max-w-full px-4 md:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="text-gray-900">
                    <table class="w-full table-fixed">
                        <thead class="bg-gray-300 text-left sticky top-0 z-30 border-t border-gray-900 shadow-sm">
                            <tr class="hover:bg-gray-300">
                                <th class="px-4 py-3">Nome do Cliente</th>
                                <th class="px-4 py-3">Veículo Novo</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Valor da Proposta</th>
                                <th class="px-4 py-3">Vendedor</th>
                                <th class="px-4 py-3">Data Proposta</th>
                                <th class="px-4 py-3">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="text-sm text-gray-700">

                            @foreach ($propostas as $proposta)
                            <tr class="hover:bg-gray-100 border-t">
                                <td class="px-4 py-2">{{ $proposta->cliente->nome ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $proposta->veiculoNovo->desc_veiculo ?? '-' }}</td>
                                <td class="px-4 py-2">{{ ucfirst($proposta->status) }}</td>
                                <td class="px-4 py-2 font-medium text-green-700">
                                    R$ {{ number_format($proposta->negociacoes->sum('valor'), 2, ',', '.') }}
                                </td>
                                <td class="px-4 py-2">{{ $proposta->usuario->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{
                                    \Carbon\Carbon::parse($proposta->data_proposta)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex gap-2">

                                        <a href="{{ route('propostas.visualizar', $proposta->id) }}" target="_blank"
                                            title="Visualizar"
                                            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm flex items-center justify-center">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('propostas.editar', $proposta->id) }}" title="Editar"
                                            class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-sm flex items-center justify-center">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @acessoAssistente()
                                        <a href="{{ route('propostas.aprovar', $proposta->id) }}" title="Aprovar"
                                            class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm flex items-center justify-center">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                        @endacessoAssistente

                                    </div>

                                </td>
                            </tr>
                            @endforeach


                            @if ($propostas->isEmpty())
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500">Nenhuma proposta encontrada.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Rodapé -->
                <x-rodape>
                    <div class="font-medium">Total de propostas: {{ $propostas->total() }}</div>
                    <div class="pagination">{{ $propostas->links() }}</div>

                    <div class="flex flex-wrap gap-1 items-center">
                        <span class="font-medium">Cadastro de Propostas</span>
                    </div>
                </x-rodape>
            </div>
        </div>
    </div>
</x-app-layout>
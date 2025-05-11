<x-app-layout>
    <div x-data="{
        showModalCliente: false,
        editModal: false,
        editData: {
            id: null,
            nome: '',
            tipo_pessoa: '',
            cpf_cnpj: '',
            email: '',
            celular: '',
            telefone: '',
            telefone_comercial: '',
            cep: '',
            endereco: '',
            numero: '',
            complemento: '',
            bairro: '',
            cidade: '',
            uf: '',
            sexo: '',
            estado_civil: '',
            data_nascimento: '',
            data_fundacao: '',
            razao_social: '',
            nome_fantasia: '',
            inscricao_estadual: '',
            inscricao_municipal: '',
            observacoes: '',
            ativo: true
        }
    }">



        <!-- Cabeçalho -->
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 px-4 py-4 bg-white shadow rounded-md border">
            <h2 class="text-2xl font-semibold text-green-700">Gerenciar Clientes</h2>

            <!-- Filtro -->
            <form method="GET" action="{{ route('clientes.index') }}" class="flex gap-2 w-full">
                <input type="text" name="busca" value="{{ request('busca') }}"
                    placeholder="Buscar por nome, email ou CPF/CNPJ..."
                    class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition flex items-center gap-1">
                    <i class="fas fa-search"></i> Buscar
                </button>
                @if (request('busca'))
                <a href="{{ route('clientes.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition flex items-center gap-1">
                    <i class="fas fa-broom"></i> Limpar
                </a>
                @endif
            </form>

            <!-- Botão Novo -->
            <div class="text-right">
                <button @click="showModalCliente = true"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                    + Novo Cliente
                </button>
            </div>
        </div>

        <!-- Tabela de clientes -->
        <div class="w-full max-w-full px-4 md:px-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="text-gray-900" id="tabela-wrapper">
                        <table class="w-full table-fixed">
                            <thead class="bg-gray-300 text-left sticky top-0 z-30 border-t border-gray-900 shadow-sm">
                                <tr class="hover:bg-gray-300">
                                    <th class="px-4 py-3">Nome</th>
                                    <th class="px-4 py-3">Tipo</th>
                                    <th class="px-4 py-3">CPF/CNPJ</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                                @foreach ($clientes as $cliente)
                                <tr class="hover:bg-gray-100 border-t">
                                    <td class="px-4 py-2">{{ $cliente->nome }}</td>
                                    <td class="px-4 py-2">{{ $cliente->tipo_pessoa }}</td>
                                    <td class="px-4 py-2">{{ $cliente->cpf_cnpj }}</td>
                                    <td class="px-4 py-2">{{ $cliente->email }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex gap-2">
                                            <!-- Botão editar -->
                                            <button @click="editModal = true; editData = {{ json_encode($cliente) }}"
                                                class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-sm">
                                                Editar
                                            </button>

                                            <!-- Botão excluir -->
                                            <form method="POST" action="{{ route('clientes.destroy', $cliente->id) }}"
                                                onsubmit="return confirm('Deseja excluir este cliente?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                @if ($clientes->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">Nenhum cliente
                                        encontrado.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Novo Cliente -->
                <div x-show="showModalCliente"
                    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
                    style="display: none;">
                    <div @click.away="showModalCliente = false" class="bg-white p-6 rounded-lg w-full max-w-3xl shadow-lg">
                        @include('clientes.partials.form-create')
                    </div>
                </div>

                <!-- Modal Editar Cliente -->
                <div x-show="editModal"
                    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex  justify-center"
                    style="display: none;">
                    <div @click.away="editModal = false"
                        {{-- class="bg-white p-6 rounded-lg w-full max-w-3xl max-h-[90vh] overflow-y-auto shadow-lg items-start"> --}}
                        @include('clientes.partials.form-edit')
                    </div>
                </div>

                <!-- Rodapé -->
                <x-rodape>
                    <div class="font-medium">Total de clientes: {{ $clientes->total() }}</div>
                    <div class="pagination">{{ $clientes->links() }}</div>

                    <!-- Legenda de cores -->
                    <div class="flex flex-wrap gap-1 items-center">
                        <span class="font-medium">Cadastro de Clientes</span>
                    </div>
                </x-rodape>

            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                    @if (session('abrirModalCreate'))
                        setTimeout(() => { document.querySelector('[x-data]').__x.$data.showModal = true }, 100);
                    @endif
            
                    @if (session('abrirModalEdit'))
                        setTimeout(() => {
                            let edit = {!! json_encode(session('editData')) !!};
                            let app = document.querySelector('[x-data]').__x.$data;
                            app.editData = edit;
                            app.editModal = true;
                        }, 100);
                    @endif
                });
        </script>


</x-app-layout>
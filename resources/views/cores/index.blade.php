<x-app-layout>
    <div x-data="{
        showModal: false,
        editModal: false,
        editData: {
            id: null,
            cor_desc: ''
        }
    }" class="py-1 px-1 max-w-4xl mx-auto">

        <!-- Cabeçalho -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-green-700">Gerenciar Cores</h2>
            <x-bt-ajuda />
        </div>

        <!-- Filtro + Botão Novo -->
        <form method="GET" action="{{ route('cores.index') }}" class="flex flex-wrap items-end gap-2 mb-4">
            <div class="flex-1">
                <label for="busca" class="text-sm font-medium text-gray-700">Buscar cor:</label>
                <input type="text" name="busca" id="busca" value="{{ request('busca') }}" placeholder="Digite a cor..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-400 focus:outline-none" />
            </div>

            <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 whitespace-nowrap">
                <i class="fas fa-search mr-1"></i> Buscar
            </button>

            @if (request('busca'))
                <a href="{{ route('cores.index') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 whitespace-nowrap">
                    <i class="fas fa-broom mr-1"></i> Limpar
                </a>
            @endif

            <button type="button" @click="showModal = true"
                class="ml-auto bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 whitespace-nowrap">
                + Nova Cor
            </button>
        </form>

        <!-- Tabela -->
        <div class="w-full max-w-full px-4 md:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                <div id="tabela-wrapper">
                    <table class="w-full table-fixed">
                        <thead class="bg-gray-300 text-left sticky top-0 z-30 border-t border-gray-900 shadow-sm">
                            <tr>
                                <th class="px-4 py-2 border-b">Código</th>
                                <th class="px-4 py-2 border-b">Descrição</th>
                                <th class="px-4 py-2 border-b text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse ($cores as $cor)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border-b">{{ $cor->id }}</td>
                                    <td class="px-4 py-2 border-b">{{ $cor->cor_desc }}</td>
                                    <td class="px-4 py-2 border-b text-right">
                                        <div class="flex justify-end gap-2">
                                            <button @click="editModal = true; editData = {
                                                    id: {{ $cor->id }},
                                                    cor_desc: '{{ addslashes($cor->cor_desc) }}'
                                                }"
                                                class="px-3 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 text-sm">
                                                Editar
                                            </button>

                                            <form action="{{ route('cores.destroy', $cor->id) }}" method="POST"
                                                onsubmit="return confirm('Deseja excluir esta cor?')">
                                                @csrf @method('DELETE')
                                                <button
                                                    class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-500">Nenhuma cor encontrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Rodapé -->
        <x-rodape>
            <div class="font-medium">Total de cores cadastradas: {{ $cores->total() }}</div>
            <div class="pagination">{{ $cores->links() }}</div>
            <div class="flex flex-wrap gap-1 items-center">
                <span class="font-medium">Gerenciamento de Cores</span>
            </div>
        </x-rodape>

        <!-- Modais -->
        @include('cores.partials.form-create')
        @include('cores.partials.form-edit')
    </div>
    <!-- Modal de Ajuda -->
    <div id="modalAjuda" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full p-6 relative flex gap-6">

            <!-- Ícone -->
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 text-6xl"></i>
            </div>

            <!-- Conteúdo -->
            <div class="flex-1 relative">
                <!-- Botão fechar -->
                <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                    class="absolute top-0 right-0 text-red-500 hover:text-red-700 text-2xl">&times;</button>

                <h2 class="text-2xl font-bold text-blue-600 mb-4">
                    Instruções para Gerenciamento de Cores
                </h2>

                <p class="mb-3 text-sm text-gray-700 leading-relaxed">
                    Esta tela permite <strong>cadastrar, editar e excluir</strong> cores utilizadas no sistema de
                    veículos.
                    As cores cadastradas poderão ser vinculadas a modelos de veículos durante o cadastro ou edição,
                    auxiliando na padronização de informações para exibição e impressão de propostas.
                </p>

                <ul class="list-disc list-inside text-sm text-gray-800 space-y-2">
                    <li><strong>Buscar cor:</strong> Digite parte da descrição para localizar cores já cadastradas.</li>
                    <li><strong>+ Nova Cor:</strong> Clique no botão azul para abrir o modal de cadastro de uma nova
                        cor.</li>
                    <li><strong>Editar:</strong> Utilize o botão amarelo ao lado de uma cor para alterar sua descrição.
                    </li>
                    <li><strong>Excluir:</strong> Clique no botão vermelho para remover uma cor. Só será possível
                        excluir se ela não estiver em uso.</li>
                    <li><strong>Paginação:</strong> No rodapé, você pode navegar entre páginas e visualizar o total de
                        cores cadastradas.</li>
                    <li><strong>Reutilização:</strong> As cores aqui cadastradas serão exibidas em diversas partes do
                        sistema, como propostas, catálogos e relatórios.</li>
                </ul>

                <div class="mt-6 text-right">
                    <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                        class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                        Entendi!
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<x-app-layout>
    <div x-data="{
        showModal: false,
        editModal: false,
        openDescricaoId: null,
        excluirModal: false,
        carregado: false,
        idExcluir: null,
        editData: {
            id: null,
            modelo_fab: '',
            cod_opcional: '',
            descricao: ''
        },
        confirmarExclusao(id) {
            this.idExcluir = id;
            this.excluirModal = true;
        }
    }" x-init="$nextTick(() => carregado = true)">
        <div x-show="carregado" x-cloak class="py-1 px-1 max-w-4xl mx-auto">

            <!-- Cabeçalho -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-green-700">Gerenciar Opcionais dos Modelos</h2>
                <x-bt-ajuda />
            </div>

            <!-- Filtro e Botão Novo -->
            <form method="GET" action="{{ route('opcionais.index') }}" class="flex flex-wrap items-end gap-2 mb-4">
                <div class="flex-1">
                    <label for="busca" class="text-sm font-medium text-gray-700">Buscar por modelo ou código:</label>
                    <input type="text" name="busca" id="busca" value="{{ request('busca') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-400 focus:outline-none"
                        placeholder="Ex: 5A43BS, 5PK, etc." />
                </div>

                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 whitespace-nowrap">
                    <i class="fas fa-search mr-1"></i> Buscar
                </button>

                @if (request('busca'))
                    <a href="{{ route('opcionais.index') }}"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 whitespace-nowrap">
                        <i class="fas fa-broom mr-1"></i> Limpar
                    </a>
                @endif

                <button type="button" @click="showModal = true"
                    class="ml-auto bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 whitespace-nowrap">
                    + Novo Opcional
                </button>
            </form>

            <!-- Tabela -->
            <div class="w-full max-w-full px-4 md:px-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                    <table class="w-full table-fixed">
                        <thead class="bg-gray-300 text-left sticky top-0 z-30 border-t border-gray-900 shadow-sm">
                            <tr>
                                <th class="w-1/4 px-4 py-2 border-b text-center">Modelo/Fab</th>
                                <th class="w-1/4 px-4 py-2 border-b text-center">Código</th>
                                <th class="w-1/2 px-4 py-2 border-b text-center">Descrição</th>
                                <th class="w-1/4 px-4 py-2 border-b text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse ($opcionais as $opcional)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border-b text-center">{{ $opcional->modelo_fab }}</td>
                                    <td class="px-4 py-2 border-b text-center">{{ $opcional->cod_opcional }}</td>
                                    <td class="px-4 py-2 border-b text-center">
                                        <div class="flex justify-center gap-2">
                                            <div class="truncate max-w-[200px]">
                                                {{ Str::limit($opcional->descricao, 120, '...') }}
                                            </div>
                                            <button @click="openDescricaoId = {{ $opcional->id }}"
                                                class="text-blue-600 hover:text-blue-800 hover:underline text-sm whitespace-nowrap">
                                                <i class="fa-solid fa-eye mr-1"></i> Ver mais
                                            </button>
                                        </div>

                                        <!-- Modal de Descrição -->
                                        <div x-show="openDescricaoId === {{ $opcional->id }}"
                                            class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
                                            style="display: none;">
                                            <div @click.away="openDescricaoId = null"
                                                class="bg-white p-6 rounded-lg max-w-xl w-full shadow-lg">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                                    Descrição Completa — Modelo: {{ $opcional->modelo_fab }} | Código:
                                                    {{ $opcional->cod_opcional }}
                                                </h3>
                                                <ul
                                                    class="text-gray-700 list-disc pl-5 space-y-1 max-h-64 overflow-y-auto pr-2 text-left">
                                                    @foreach (explode('/', $opcional->descricao) as $item)
                                                        <li>{{ trim($item) }}</li>
                                                    @endforeach
                                                </ul>
                                                <div class="mt-6 text-right">
                                                    <button @click="openDescricaoId = null"
                                                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                                        Fechar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 border-b text-center">
                                        <div class="flex justify-center gap-2">
                                            <button
                                                @click="editModal = true; editData = {
                                                                                                                                                    id: {{ $opcional->id }},
                                                                                                                                                    modelo_fab: '{{ addslashes($opcional->modelo_fab) }}',
                                                                                                                                                    cod_opcional: '{{ addslashes($opcional->cod_opcional) }}',
                                                                                                                                                    descricao: `{{ addslashes($opcional->descricao) }}`
                                                                                                                                                }"
                                                class="px-3 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 text-sm">
                                                Editar
                                            </button>
                                            <x-modal-excluir :id="$opcional->id" :action="route('opcionais.destroy', $opcional->id)" :registro="'Modelo: ' .
                                                $opcional->modelo_fab .
                                                ' | Código: ' .
                                                $opcional->cod_opcional">
                                                <x-slot:trigger>
                                                    <button @click="show = true"
                                                        class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm">
                                                        Excluir
                                                    </button>
                                                </x-slot:trigger>
                                            </x-modal-excluir>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">Nenhum opcional
                                        encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Rodapé -->
            <x-rodape>
                <div class="font-medium">Total de opcionais cadastrados: {{ $opcionais->total() }}</div>
                <div class="pagination">{{ $opcionais->links() }}</div>
                <div class="flex flex-wrap gap-1 items-center">
                    <span class="font-medium">Gerenciar Opcionais dos Modelos</span>
                </div>
            </x-rodape>

            <!-- Modal de Criação -->
            <div x-show="showModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
                style="display: none;">
                <div @click.away="showModal = false" class="bg-white p-6 rounded-lg w-full max-w-2xl shadow-lg">
                    @include('opcionais.partials.form-create')
                </div>
            </div>

            <!-- Modal de Edição -->
            <div x-show="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
                style="display: none;">
                <div @click.away="editModal = false"
                    class="bg-white p-6 rounded-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-lg">
                    @include('opcionais.partials.form-edit')
                </div>
            </div>

            <!-- Modal de Ajuda -->
            <div id="modalAjuda"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div
                    class="bg-white rounded-lg shadow-xl max-w-3xl w-full p-6 relative flex gap-6 animate-shake border-t-4 border-blue-400">
                    <!-- Ícone  -->
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white p-2 rounded-full shadow">
                        <i class="fas fa-info-circle text-blue-500 text-4xl"></i>
                    </div>
                    <!-- Conteúdo -->
                    <div class="flex-1 relative">
                        <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                            class="absolute top-0 right-0 text-red-500 hover:text-red-700 text-2xl">
                            &times;
                        </button>

                        <h2 class="text-2xl font-bold text-blue-600 mb-4">Instruções para Gerenciamento de Opcionais
                        </h2>

                        <p class="mb-3 text-sm text-gray-700 leading-relaxed">
                            Esta tela permite <strong>cadastrar, editar, visualizar e excluir</strong> opcionais
                            associados
                            aos modelos de veículos.
                            Esses opcionais são usados na ficha técnica e propostas comerciais.
                        </p>

                        <ul class="list-disc list-inside text-sm text-gray-800 space-y-2">
                            <li><strong>Busca:</strong> Use o campo superior para localizar por modelo ou código.</li>
                            <li><strong>Novo:</strong> Clique em "+ Novo Opcional" para adicionar um registro.</li>
                            <li><strong>Ver mais:</strong> Exibe a descrição completa em lista.</li>
                            <li><strong>Editar:</strong> Altere os dados rapidamente pelo botão amarelo.</li>
                            <li><strong>Excluir:</strong> Só é possível remover registros não utilizados.</li>
                            <li><strong>Paginação:</strong> Navegue e veja o total no rodapé.</li>
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
        </div>
</x-app-layout>

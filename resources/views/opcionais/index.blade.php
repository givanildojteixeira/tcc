<x-app-layout>
    <!-- Envolve toda a tela com Alpine.js -->
    <div x-data="{
        showModal: false,
        openDescricaoId: null,
        editModal: false,
        editData: {
            id: null,
            modelo_fab: '',
            cod_opcional: '',
            descricao: ''
        }
    }" class="flex flex-col h-screen">

        <!-- 🔝 Header -->
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 px-4 h-screen py-4 pb-4 bg-white shadow rounded-md border">
            <!-- 🟩 Título -->
            <h2 class="text-2xl font-semibold text-green-700">
                Gerenciar Opcionais dos Modelos
            </h2>

            <!-- 🔍 Filtro com botão buscar e limpar -->
            <form method="GET" action="{{ route('opcionais.index') }}" class="flex gap-2 w-full">
                <!-- Campo de texto -->
                <input type="text" name="busca" value="{{ request('busca') }}"
                    placeholder="Buscar por modelo ou código..."
                    class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />

                <!-- Botão Buscar (verde) -->
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition flex items-center gap-1">
                    <i class="fas fa-search"></i>
                    Buscar
                </button>

                <!-- Botão Limpar -->
                @if (request('busca'))
                    <a href="{{ route('opcionais.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition flex items-center gap-1">
                        <i class="fas fa-broom"></i>
                        Limpar
                    </a>
                @endif
            </form>

            <!-- ➕ Botão novo -->
            <div class="text-right">
                <button @click="showModal = true"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                    + Novo Opcional
                </button>
            </div>

        </div>

        <!-- 🧾 Conteúdo com scroll interno -->
        <div class="w-full max-w-full px-4 md:px-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="text-gray-900" id="tabela-wrapper">
                        <table class="w-full table-fixed">
                            <thead class="bg-gray-300 text-left sticky top-0 z-30 border-t border-gray-900 shadow-sm">
                                <tr class="hover:bg-gray-300">
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Modelo/Fab</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Código</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Descrição</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach ($opcionais as $opcional)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-800 border-x border-gray-600 ">
                                            {{ $opcional->modelo_fab }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800">{{ $opcional->cod_opcional }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-800 max-w-[300px]">
                                            <div class="flex items-center justify-between gap-2">
                                                <div class="truncate max-w-[200px]">
                                                    {{ Str::limit($opcional->descricao, 120, '...') }}
                                                </div>
                                                <button @click="openDescricaoId = {{ $opcional->id }}"
                                                    class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 hover:underline text-sm transition whitespace-nowrap">
                                                    <i class="fa-solid fa-eye"></i> Ver mais
                                                </button>
                                            </div>
                                            <!-- Modal de Descrição -->
                                            <div x-show="openDescricaoId === {{ $opcional->id }}"
                                                class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
                                                style="display: none;">
                                                <div @click.away="openDescricaoId = null"
                                                    class="bg-white p-6 rounded-lg max-w-xl w-full shadow-lg">
                                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Descrição
                                                        Completa =>  Modelo :  {{ $opcional->modelo_fab }}  Codigo: {{ $opcional->cod_opcional }}</h3>
                                                    <ul
                                                        class="text-gray-700 list-disc pl-5 space-y-1 max-h-64 overflow-y-auto pr-2">
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
                                        <td class="px-6 py-4 text-sm text-gray-800">
                                            <div class="flex gap-2">
                                                <button
                                                    @click="editModal = true; editData = {
                                                id: {{ $opcional->id }},
                                                modelo_fab: '{{ addslashes($opcional->modelo_fab) }}',
                                                cod_opcional: '{{ addslashes($opcional->cod_opcional) }}',
                                                descricao: `{{ addslashes($opcional->descricao) }}`
                                            }"
                                                    class="px-3 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 transition text-sm">
                                                    Editar
                                                </button>

                                                <form action="{{ route('opcionais.destroy', $opcional->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Deseja realmente excluir esse opcional?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition text-sm">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($opcionais->isEmpty())
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Nenhum opcional
                                            encontrado.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- 🧩 Modal de Novo Opcional -->
            <div x-show="showModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
                style="display: none;">
                <div @click.away="showModal = false" class="bg-white p-6 rounded-lg w-full max-w-2xl shadow-lg">
                    @include('opcionais.partials.form-create')
                </div>
            </div>

            <!-- ✏️ Modal de Edição -->
            <div x-show="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
                style="display: none;">
                <div @click.away="editModal = false"
                    class="bg-white p-6 rounded-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-lg">
                    @include('opcionais.partials.form-edit')
                </div>
            </div>
        </div>
        <x-rodape>

            <!-- Número de veículos listados -->
            <div class="font-medium" id="selectedVehiclesCount">
                Total de opcionais cadastrados: {{ $opcionais->total() }}
            </div>

            <!-- Paginação -->
            <div class="pagination">
                {{ $opcionais->links() }}
            </div>

            <!-- Legenda de cores -->
            <div class="flex flex-wrap gap-1 items-center">
                <span class="font-medium">Gerenciar Opcionais dos Modelos</span>
            </div>
        </x-rodape>
</x-app-layout>

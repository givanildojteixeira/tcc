<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <div class="max-w-7xl mx-auto p-6" x-data="{
            showModal: false,
            openDescricaoId: null,
            editModal: false,
            editData: {
                id: null,
                modelo_fab: '',
                cod_opcional: '',
                descricao: ''
            }
        }">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-green-700">Gerenciar Opcionais dos Modelos</h2>
                <button @click="showModal = true"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    + Novo Opcional
                </button>
            </div>

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Modelo/Fab</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Código</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Descrição</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($opcionais as $opcional)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $opcional->modelo_fab }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $opcional->cod_opcional }}</td>

                                <td class="px-6 py-4 text-sm text-gray-800">
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="text-sm text-gray-800 truncate">
                                            {{ Str::limit($opcional->descricao, 100, '...') }}
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
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Descrição Completa</h3>
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

                                        <form action="{{ route('opcionais.destroy', $opcional->id) }}" method="POST"
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
                                    encontrado.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- Modal -->
            <div x-show="showModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
                style="display: none;">
                <div @click.away="showModal = false" class="bg-white p-6 rounded-lg w-full max-w-2xl shadow-lg">
                    <h3 class="text-2xl font-semibold text-green-700">Cadastrar Novo Opcional</h3>
                    <form action="{{ route('opcionais.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Modelo/Fab</label>
                                <input type="text" name="modelo_fab"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Código do Opcional</label>
                                <input type="text" name="cod_opcional"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                        </div>


                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="descricao" id="descricao" rows="4" maxlength="5000"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        </div>


                        <div class="flex justify-between mt-6">
                            <div class="flex justify-end gap-3 mt-6">
                                <!-- Botão Salvar -->
                                <button type="submit"
                                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    <span>Salvar</span>
                                </button>

                                <!-- Botão Cancelar -->
                                <button type="button" @click="showModal = false"
                                    class="flex items-center gap-2 text-gray-700 border border-gray-300 hover:bg-gray-100 px-4 py-2 rounded-md transition">
                                    <i class="fa-solid fa-xmark"></i>
                                    <span>Cancelar</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal de Edição -->
            <div x-show="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
                style="display: none;">
                <div @click.away="editModal = false"
                    class="bg-white p-6 rounded-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-lg">
                    <h3 class="text-2xl font-semibold text-yellow-700">Editar Opcional</h3>
                    {{-- <form :action="`{{ url('/opcionais') }}/${editData.id}`" method="POST" class="space-y-4"> --}}
                    <form :action="`/opcionais/${editData.id}`" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Modelo/Fab</label>
                                <input type="text" name="modelo_fab" x-model="editData.modelo_fab"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Código do Opcional</label>
                                <input type="text" name="cod_opcional" x-model="editData.cod_opcional"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="descricao" id="descricao" rows="4" maxlength="5000" x-model="editData.descricao"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        </div>

                        <div class="flex justify-end gap-3 mt-6">
                            <button type="submit"
                                class="flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition">
                                <i class="fa-solid fa-pen-to-square"></i> Atualizar
                            </button>

                            <button type="button" @click="editModal = false"
                                class="flex items-center gap-2 text-gray-700 border border-gray-300 hover:bg-gray-100 px-4 py-2 rounded-md transition">
                                <i class="fa-solid fa-xmark"></i> Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div x-data="{
        showModal: false,
        editModal: false,
        editData: {
            id: null,
            cor_desc: ''
        }
    }" class="flex flex-col h-screen">

        <!-- 🔝 Cabeçalho -->
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 px-4 py-4 bg-white shadow rounded-md border">
            <h2 class="text-2xl font-semibold text-green-700">Gerenciar Cores</h2>

            <form method="GET" action="{{ route('cores.index') }}" class="flex gap-2 w-full">
                <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar cor..."
                    class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />

                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition flex items-center gap-1">
                    <i class="fas fa-search"></i> Buscar
                </button>

                @if (request('busca'))
                <a href="{{ route('cores.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition flex items-center gap-1">
                    <i class="fas fa-broom"></i> Limpar
                </a>
                @endif
            </form>
            <!-- ➕ Botão novo -->
            <div class="text-right">
                <button @click="showModal = true"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                    + Nova Cor
                </button>
            </div>
        </div>

        <!-- 📄 Tabela -->
        <div class="w-full max-w-full px-4 md:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                <div id="tabela-wrapper">
                    <div class="w-full md:w-1/2 mx-auto">
                        <table class="w-full table-fixed">
                            <thead class="bg-gray-300 text-left sticky top-0 z-30 border-t border-gray-900 shadow-sm">
                                <tr>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Código</th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Descrição</th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach ($cores as $cor)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 border-x border-gray-600">{{ $cor->id }}</td>
                                    <td class="px-6 py-4">{{ $cor->cor_desc }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <button @click="editModal = true; editData = {
                                                    id: {{ $cor->id }},
                                                    cor_desc: '{{ addslashes($cor->cor_desc) }}'
                                                }"
                                                class="px-3 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 transition text-sm">
                                                Editar
                                            </button>

                                            <form action="{{ route('cores.destroy', $cor->id) }}" method="POST"
                                                onsubmit="return confirm('Deseja excluir esta cor?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                @if ($cores->isEmpty())
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Nenhuma cor encontrada.
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- 🧾 Rodapé -->
        <x-rodape>
            <div class="font-medium">Total de cores cadastradas: {{ $cores->total() }}</div>
            <div class="pagination">{{ $cores->links() }}</div>
            <div class="flex flex-wrap gap-1 items-center">
                <span class="font-medium">Gerenciamento de Cores</span>
            </div>
        </x-rodape>

        <!-- Modal de Criação -->
        @include('cores.partials.form-create')

        <!-- Modal de Edição -->
        @include('cores.partials.form-edit')

    </div>
</x-app-layout>
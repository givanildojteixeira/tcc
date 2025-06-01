<x-app-layout>

    <div class="py-1 px-1 max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-green-700">
                Gerenciar Condições de Pagamento
            </h2>
            <x-bt-ajuda />
        </div>

        <form method="POST" action="{{ route('condicao_pagamento.store') }}" class="mb-4 mt-2">
            @csrf
            <div class="flex items-end gap-2">
                <!-- Label e input lado a lado -->
                <label for="descricao" class="text-sm font-medium text-gray-700 self-center">Nova Condição:</label>

                <input type="text" name="descricao" id="descricao" required
                    class="flex-grow border border-gray-300 rounded-md shadow-sm px-3 py-2 w-64 focus:ring-green-400 focus:outline-none">

                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 whitespace-nowrap">
                    Cadastrar
                </button>
            </div>
        </form>

        <div class="w-full max-w-full px-4 md:px-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="text-gray-900" id="tabela-wrapper">
                        <table class="min-w-full bg-white border text-sm">
                            <thead class="bg-gray-300 text-left sticky top-0 z-30 border-t border-gray-900 shadow-sm">
                                <tr>
                                    <th class="w-[80px] px-2 py-2 border-b text-center">ID</th>
                                    <th class="w-[240px] px-2 py-2 border-b text-center">Descrição</th>
                                    <th class="w-[400px] px-2 py-2 border-b text-center">Ações</th>
                                    <th class="w-[400px] px-2 py-2 border-b text-center">Contas a Receber</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($condicoes as $condicao)
                                    <tr class="text-sm">
                                        <td class="px-4 py-2 border-b text-center truncate">{{ $condicao->id }}</td>
                                        <td class="px-4 py-2 border-b truncate">{{ $condicao->descricao }}</td>
                                        <td class="px-4 py-2 border-b text-right truncate">
                                            <div class="flex items-center gap-2">
                                                <form method="POST"
                                                    action="{{ route('condicao_pagamento.update', $condicao) }}"
                                                    class="inline-block ml-2">
                                                    @csrf @method('PUT')
                                                    <input type="text" name="descricao" value="{{ $condicao->descricao }}"
                                                        class="border rounded px-2 py-1 text-sm" required>
                                                    <button
                                                        class="ml-1 bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Salvar
                                                    </button>
                                                </form>
                                                <x-modal-excluir :id="$condicao->id"
                                                    :action="route('condicao_pagamento.destroy', $condicao)"
                                                    :registro="'Condição de Pagamento: ' . $condicao->descricao">
                                                    <x-slot:trigger>
                                                        <button @click="show = true"
                                                            class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm">
                                                            Excluir
                                                        </button>
                                                    </x-slot:trigger>
                                                </x-modal-excluir>
                                            </div>
                                        </td>

                                        {{-- Checkbox para marcar se deve aparecer no financeiro --}}
                                        <td class="px-4 py-2 border-b truncate text-center">
                                            <form method="POST"
                                                action="{{ route('condicao_pagamento.update', ['id' => $condicao->id]) }}"
                                                x-data class="inline">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="descricao" value="{{ $condicao->descricao }}">
                                                <input type="hidden" name="financeira" value="0">

                                                <label class="relative inline-flex items-center cursor-pointer text-center">
                                                    <input type="checkbox" name="financeira" value="1" class="sr-only peer"
                                                        {{ $condicao->financeira ? 'checked' : '' }}
                                                        @change="$el.form.submit()">

                                                    <!-- Trilha -->
                                                    <div
                                                        class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-500 transition-all duration-300">
                                                    </div>

                                                    <!-- Bolinha -->
                                                    <div
                                                        class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow-md transform peer-checked:translate-x-5 transition-transform duration-300">
                                                    </div>
                                                </label>
                                            </form>




                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
    </div>
    <!-- Rodapé -->
    <x-rodape>
        <div class="font-medium">Total de Condições cadastradas: {{ $condicoes->total() }}</div>
        <div class="pagination">{{ $condicoes->links() }}</div>

        <!-- Legenda de cores -->
        <div class="flex flex-wrap gap-1 items-center">
            <span class="font-medium">Cadastro de Condições de Pagamento</span>
        </div>
    </x-rodape>

    <!-- Modal de Ajuda -->
    <div id="modalAjuda" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div
            class="bg-white rounded-lg shadow-xl max-w-3xl w-full p-6 relative flex gap-6 animate-shake border-t-4 border-blue-400">
            <!-- Ícone  -->
            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white p-2 rounded-full shadow">
                <i class="fas fa-info-circle text-blue-500 text-4xl"></i>
            </div>

            <!-- Conteúdo -->
            <div class="flex-1 relative">
                <!-- Botão fechar -->
                <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                    class="absolute top-0 right-0 text-red-500 hover:text-red-700 text-2xl">&times;</button>

                <h2 class="text-2xl font-bold text-blue-600 mb-4">
                    Instruções para Gerenciamento de Condições de Pagamento
                </h2>

                <p class="mb-3 text-sm text-gray-700 leading-relaxed">
                    Esta tela permite <strong>cadastrar, editar e excluir</strong> condições de pagamento utilizadas em
                    propostas de venda. As condições cadastradas poderão ser utilizadas posteriormente no vínculo com
                    negociações.
                </p>

                <ul class="list-disc list-inside text-sm text-gray-800 space-y-2">
                    <li><strong>Nova Condição:</strong> Informe um nome descritivo (ex: "À vista", "Entrada + 24x").
                    </li>
                    <li><strong>Cadastrar:</strong> Clique no botão verde para salvar uma nova condição no sistema.</li>
                    <li><strong>Edição Inline:</strong> Altere diretamente a descrição clicando no campo ao lado da
                        condição já cadastrada.</li>
                    <li><strong>Excluir:</strong> Utilize o botão "Excluir" para remover uma condição (somente se não
                        estiver em uso).</li>
                    <li><strong>Paginação:</strong> O rodapé exibe paginação e o total de registros cadastrados.</li>
                    <li><strong>Integração com Propostas:</strong> Cada condição cadastrada poderá ser selecionada ao
                        definir formas de pagamento em propostas.</li>
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
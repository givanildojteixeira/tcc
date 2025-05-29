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
                        <table class="w-full table-fixed">
                            <thead class="bg-gray-300 text-left sticky top-0 z-30 border-t border-gray-900 shadow-sm">
                                <tr class="hover:bg-gray-300">
                                    <th class="px-4 py-2 border-b">ID</th>
                                    <th class="px-4 py-2 border-b">Descrição</th>
                                    <th class="px-4 py-2 border-b text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($condicoes as $condicao)
                                    <tr class="text-sm">
                                        <td class="px-4 py-2 border-b">{{ $condicao->id }}</td>
                                        <td class="px-4 py-2 border-b">{{ $condicao->descricao }}</td>
                                        <td class="px-4 py-2 border-b text-right">
                                            <form method="POST"
                                                action="{{ route('condicao_pagamento.destroy', $condicao) }}"
                                                onsubmit="return confirm('Tem certeza que deseja excluir?')"
                                                class="inline-block">
                                                @csrf @method('DELETE')
                                                <button class="text-red-600 hover:underline">Excluir</button>
                                            </form>
                                            <form method="POST" action="{{ route('condicao_pagamento.update', $condicao) }}"
                                                class="inline-block ml-2">
                                                @csrf @method('PUT')
                                                <input type="text" name="descricao" value="{{ $condicao->descricao }}"
                                                    class="border rounded px-2 py-1 text-sm" required>
                                                <button
                                                    class="ml-1 bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Salvar</button>
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
        {{-- <div class="mt-4">{{ $condicoes->links() }}</div> --}}

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
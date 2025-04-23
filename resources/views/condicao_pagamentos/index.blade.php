<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Condições de Pagamento</h2>
    </x-slot> --}}

    <div class="py-1 px-1 max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold text-green-700">
            Gerenciar Condições de Pagamento
        </h2>
        <form method="POST" action="{{ route('condicao_pagamento.store') }}" class="mb-6">
            @csrf
            <div class="flex gap-4 items-end">
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-gray-700">Nova Condição</label>
                    <input type="text" name="descricao" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Cadastrar</button>
            </div>
        </form>

        @if (session('success'))
        <div class="mb-4 text-green-700 font-medium">{{ session('success') }}</div>
        @endif



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
</x-app-layout>
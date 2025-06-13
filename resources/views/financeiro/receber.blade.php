<x-app-layout>
    @acessoDiretor()

    <div class="max-w-7xl mx-auto p-4">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
            <!-- Título -->
            <h2 class="text-xl font-semibold text-blue-700 col-span-2 min-w-[160px]"> 💵 Financeiro </h2>

            <!-- Botões -->
            <div class="flex gap-2 whitespace-nowrap">
                <a href="{{ route('financeiro.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center gap-2 text-sm shadow">
                    <i class="fas fa-arrow-circle-up"></i> Contas a Pagar
                </a>

                <a href="{{ route('financeiro.receber') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center gap-2 text-sm shadow">
                    <i class="fas fa-arrow-circle-down"></i> Contas a Receber
                </a>
            </div>

            {{-- CheckBox para pesquisar recebidos e nao recebidos --}}
            <form method="GET" action="{{ route('financeiro.receber') }}" class="flex items-center border border-red-500 rounded  p-1"
                title="Marque se deseja que aparece todos os titulo, inclusive os ja baixados.">
                <label class="relative inline-flex items-center cursor-pointer text-sm">
                    <input type="checkbox" id="mostrar_recebidas" name="mostrar_recebidas" value="1" class="sr-only peer"
                        {{ request()->filled('searchProposta') || request()->has('mostrar_recebidas') ? 'checked' : '' }}
                        onchange="this.form.submit()">

                    <!-- Trilha -->
                    <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-500 transition-all duration-300"></div>

                    <!-- Bolinha -->
                    <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow-md transform peer-checked:translate-x-5 transition-transform duration-300"></div>

                    <span class="ml-3 text-gray-700 select-none">Todas</span>
                </label>

                <!-- Preservar buscas existentes -->
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="searchProposta" value="{{ request('searchProposta') }}">
            </form>


            {{-- Busca Proposta --}}
            <form method="GET" action="{{ route('financeiro.receber') }}" class="flex items-center gap-2 flex-nowrap">
                <input type="text" name="searchProposta" placeholder="Buscar proposta"
                    title="Buscar proposta" value="{{ request('searchProposta') }}"
                    class="px-3 py-2 border rounded w-28 text-sm">

                <button type="submit" class="bg-green-500 text-white px-3 py-2 rounded hover:bg-green-600 text-sm">
                    <i class="fas fa-search mr-1"></i> 
                </button>

                @if (request()->has('searchProposta'))
                    <a href="{{ route('financeiro.receber') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-3 py-2 rounded text-sm flex items-center gap-1">
                        <i class="fas fa-broom"></i> 
                    </a>
                @endif
            </form>


            {{-- Outras buscas --}}
            <form method="GET" action="{{ route('financeiro.receber') }}" class="flex items-center gap-2 flex-nowrap">
                <input type="text" name="search" placeholder="Buscar cliente ou chassi"
                    title="Buscar cliente ou chassi" value="{{ $search }}"
                    class="px-3 py-2 border rounded w-48 text-sm">

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
                    <i class="fas fa-search mr-1"></i> 
                </button>

                @if (request()->has('search'))
                    <a href="{{ route('financeiro.receber') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm flex items-center gap-1">
                        <i class="fas fa-broom"></i> 
                    </a>
                @endif
            </form>
        </div>
        <table class="min-w-full bg-white border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="w-1/6 px-3 py-2 text-center">Tipo</th>
                    <th class="w-1/6 px-3 py-2 text-center">Proposta</th>
                    <th class="w-1/2 px-3 py-2 text-center">Cliente</th>
                    <th class="w-1/4 px-3 py-2 text-center">Veículo</th>
                    <th class="w-1/5 px-3 py-2 text-center">Chassi</th>
                    <th class="w-1/4 px-3 py-2 text-center">Motivo</th>
                    <th class="w-1/5 px-3 py-2 text-center">Faturamento</th>
                    <th class="w-1/5 px-3 py-2 text-center">Vencimento</th>
                    <th class="w-1/4 px-3 py-2 text-center">Valor</th>
                    <th class="w-1/4 px-3 py-2 text-center">Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse($negociacoes as $n)
                    <tr class="border-t">
                        <td class="px-3 py-2 font-bold">
                            @if ($n->pago)
                                <span class="text-green-600 text-center">Recebido</span>
                            @else
                                <span class="text-red-600 text-center">Receber</span>
                            @endif
                        </td>
                        <td class="px-3 py-2 text-center">{{ $n->proposta->id ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $n->proposta->cliente->nome ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $n->proposta->veiculo->desc_veiculo ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $n->proposta->veiculo->chassi ?? '-' }}</td>
                        <td class="px-3 py-2"><strong>{{ $n->descricao_pagamento }}</strong></td>
                        <td class="px-3 py-2">
                            {{$n->proposta->veiculo->dta_faturamento ? \Carbon\Carbon::parse($n->proposta->veiculo->dta_faturamento)->addDays(10)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-3 py-2">
                            {{$n->data_vencimento ? \Carbon\Carbon::parse($n->data_vencimento)->addDays(10)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-3 py-2 text-right">{{ number_format($n->valor, 2, ',', '.') }}</td>
                        <td class="px-3 py-2 text-center">
                            @if (!$n->pago)
                                <x-modal-question :acao="route('financeiro.receber.marcar', $n->id)" metodo="POST"
                                    titulo="Confirmar Recebimento"
                                    mensagem="Deseja marcar este valor como <strong>recebido</strong>?" cor="green">
                                    <x-slot name="trigger">
                                        <button @click="show = true"
                                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                            Receber
                                        </button>
                                    </x-slot>
                                </x-modal-question>
                            @else
                                <span class="text-green-600 font-semibold">✓</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-gray-500 py-4">Nenhum registro encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>




    </div>

    @else

        <div class="max-w-7xl mx-auto p-4">
            <div class="max-w-3xl mx-auto p-10 mt-10 bg-white shadow rounded text-center">
                <h2 class="text-2xl font-semibold text-red-600 mb-4">Acesso Negado</h2>
                <p class="text-gray-700">Você não tem permissão para visualizar esta página.</p>
                <a href="{{ route('dashboard') }}"
                    class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Voltar</a>
            </div>
        </div> 

    @endacessoDiretor
    <x-rodape>
        <div class="font-medium">Total de contas a receber: {{ $negociacoes->total() }}</div>
        <div class="pagination">{{ $negociacoes->links() }}</div>

        <!-- Legenda de cores -->
        <div class="flex flex-wrap gap-1 items-center">
            <span class="font-medium ">Legenda:</span>
            <span class="font-medium text-red-600">Receber </span>
            <span class="font-medium ">/</span>
            <span class="font-medium text-green-600">Recebido</span>
        </div>
    </x-rodape>



</x-app-layout>
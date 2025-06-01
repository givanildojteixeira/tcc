<x-app-layout>
    @acessoDiretor()

    <div class="max-w-7xl mx-auto p-4">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
            <!-- Título -->
            <h2 class="text-xl font-semibold text-blue-700 col-span-2 min-w-[160px]"> Controle Financeiro </h2>

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

            <!-- Campo de busca -->
            <form method="GET" action="{{ route('financeiro.index') }}" class="flex items-center gap-2 flex-nowrap">
                <input type="text" name="search" placeholder="Buscar proposta, cliente ou chassi"
                    title="Buscar proposta, cliente ou chassi" value="{{ $search }}"
                    class="px-3 py-2 border rounded w-48 text-sm">

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
                    <i class="fas fa-search mr-1"></i> Buscar
                </button>

                @if (request()->has('search'))
                    <a href="{{ route('financeiro.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm flex items-center gap-1">
                        <i class="fas fa-broom"></i> Limpar
                    </a>
                @endif
            </form>
        </div>
        <table class="min-w-full bg-white border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2">Tipo</th>
                    <th class="px-3 py-2">Proposta</th>
                    <th class="px-3 py-2">Cliente</th>
                    <th class="px-3 py-2">Veículo</th>
                    <th class="px-3 py-2">Chassi</th>
                    <th class="px-3 py-2">Motivo</th>
                    <th class="px-3 py-2">Faturamento</th>
                    <th class="px-3 py-2">Vencimento</th>
                    <th class="px-3 py-2">Valor</th>
                    <th class="px-3 py-2">Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse($negociacoes as $n)
                    <tr class="border-t">
                        <td class="px-3 py-2 font-bold">
                            @if ($n->pago)
                                <span class="text-green-600">Recebido</span>
                            @else
                                <span class="text-red-600">Receber</span>
                            @endif
                        </td>
                        <td class="px-3 py-2">{{ $n->proposta->id ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $n->proposta->cliente->nome ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $n->veiculo->desc_veiculo ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $n->veiculo->chassi ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $n->descricao_pagamento }}</td>
                        <td class="px-3 py-2">{{ $n->data_faturamento ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $n->data_vencimento ?? '-' }}</td>
                        <td class="px-3 py-2 text-right">R$ {{ number_format($n->valor, 2, ',', '.') }}</td>
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

    {{-- @else

    <div class="max-w-7xl mx-auto p-4">
        <div class="max-w-3xl mx-auto p-10 mt-10 bg-white shadow rounded text-center">
            <h2 class="text-2xl font-semibold text-red-600 mb-4">Acesso Negado</h2>
            <p class="text-gray-700">Você não tem permissão para visualizar esta página.</p>
            <a href="{{ route('dashboard') }}"
                class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Voltar</a>
        </div>
    </div> --}}
    @endacessoDiretor



</x-app-layout>
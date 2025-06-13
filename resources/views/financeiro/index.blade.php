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

            {{-- CheckBox para mostrar ou ocultar os pagos --}}
            <form method="GET" action="{{ route('financeiro.index') }}" class="flex items-center gap-2  border border-red-500 rounded  p-1"
                title="Mostra os titulos Pagos.">
                <label class="relative inline-flex items-center cursor-pointer text-sm">
                    <input type="checkbox" name="mostrar_pagos" value="1" class="sr-only peer"
                        {{ request()->has('mostrar_pagos') ? 'checked' : '' }}
                        onchange="this.form.submit()">

                    <!-- Trilha -->
                    <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-500 transition-all duration-300"></div>

                    <!-- Bolinha -->
                    <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow-md transform peer-checked:translate-x-5 transition-transform duration-300"></div>

                    <span class="ml-3 text-gray-700 select-none">Todas</span>
                </label>

                <!-- Preservar outras buscas -->
                <input type="hidden" name="search" value="{{ request('search') }}">
            </form>


            <!-- Campo de busca -->
            <form method="GET" action="{{ route('financeiro.index') }}" class="flex items-center gap-2 flex-nowrap">
                <input type="text" name="search" placeholder="Buscar proposta, cliente ou chassi"
                    title="Buscar proposta, cliente ou chassi" value="{{ $search }}"
                    class="px-3 py-2 border rounded w-48 text-sm">

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
                    <i class="fas fa-search mr-1"></i> 
                </button>

                {{-- @if (request()->has('search')) --}}
                    <a href="{{ route('financeiro.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm flex items-center gap-1">
                        <i class="fas fa-broom"></i> 
                    </a>
                {{-- @endif --}}
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
                @forelse($propostas as $proposta)
                    <tr class="border-t">
                        <td class="px-3 py-2 font-bold text-center">
                            @if ($proposta->veiculo->pago)
                                <span class="text-green-600">Pago</span>
                            @else
                                <span class="text-red-600">Pagar</span>
                            @endif
                        </td>
                        <td class="px-3 py-2 text-center">{{ $proposta->id }}</td>
                        <td class="px-3 py-2">{{ $proposta->cliente->nome ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $proposta->veiculo->desc_veiculo ?? '-' }}</td>
                        <td class="px-3 py-2 text-right">{{ $proposta->veiculo->chassi ?? '-' }}</td>
                        <td class="px-3 py-2">Venda Veículo</td>
                        <td class="px-3 py-2 text-center">
                            {{ $proposta->veiculo->dta_faturamento ? \Carbon\Carbon::parse($proposta->veiculo->dta_faturamento)->addDays(10)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-3 py-2 text-center">
                            {{ $proposta->veiculo->dta_vencimento ? \Carbon\Carbon::parse($proposta->veiculo->dta_vencimento)->addDays(10)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-3 py-2 text-right">
                            {{ number_format($proposta->veiculo->vlr_nota, 2, ',', '.') }}
                        </td>
                        <td class="px-3 py-2 text-center">
                            @if (!$proposta->veiculo->pago)
                                <x-modal-question :acao="route('financeiro.pagar', $proposta->veiculo->id)" metodo="POST"
                                    titulo="Confirmar Pagamento"
                                    mensagem="Deseja marcar este veículo como <strong>pago</strong>?" cor="blue">

                                    <x-slot name="trigger">
                                        <button @click="show = true"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                            Pagar
                                        </button>
                                    </x-slot>
                                </x-modal-question>
                            @else
                                <span class="text-blue-700 font-semibold">✓</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-500">Nenhuma proposta encontrada.</td>
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

    <!-- Rodapé -->
<x-rodape>
    <div class="font-medium">Total de contas a pagar: {{ $propostas->total() }}</div>
    <div class="pagination">{{ $propostas->links() }}</div>

    <!-- Legenda de cores -->
    <div class="flex flex-wrap gap-1 items-center">
        <span class="font-medium ">Legenda:</span>
        <span class="font-medium text-red-600">Pagar </span>
        <span class="font-medium ">/</span>
        <span class="font-medium text-green-600">Pago</span>
    </div>
</x-rodape>



</x-app-layout>
<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📊 Relatórios do Sistema</h1>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Relatórios Veículos Novos -->
            <x-relatorio-card titulo="Veículos Novos" cor="blue" icone="car">
                <x-relatorio-item icone="clipboard-document" texto="Estoque Atual" rota="relatorios.novos.estoque" />
                <x-relatorio-item icone="clipboard-document" texto="Vendas por Modelo no trimestre"
                    rota="relatorios.novos.vendas" />
            </x-relatorio-card>

            <!-- Relatórios Veículos Usados -->
            <x-relatorio-card titulo="Veículos Usados" cor="yellow" icone="truck">
                <x-relatorio-item icone="clipboard-document" texto="Estoque Atual usados"
                    rota="relatorios.usados.estoque" />
                {{-- <x-relatorio-item icone="clipboard-document" texto="Lucro por Veículo" rota="relatorios.usados.lucro" /> --}}
            </x-relatorio-card>

            <!-- Relatórios de Propostas -->
            <x-relatorio-card titulo="Propostas" cor="green" icone="document-text">
                <x-relatorio-item icone="check-badge" texto="Propostas Aprovadas"
                    rota="relatorios.propostas.aprovadas" />
                <x-relatorio-item icone="x-circle" texto="Propostas Rejeitadas"
                    rota="relatorios.propostas.rejeitadas" />
                <x-relatorio-item icone="clipboard-document" texto="Propostas Faturadas"
                    rota="relatorios.propostas.faturadas" />
            </x-relatorio-card>

            <!-- Relatórios Financeiros -->
            <x-relatorio-card titulo="Financeiro" cor="red" icone="banknotes">
                <x-relatorio-item icone="clipboard-document" texto="Contas a Pagar" rota="relatorios.financeiro.pagar" :usaDatas="true" />
                <x-relatorio-item icone="clipboard-document" texto="Contas a Receber" rota="relatorios.financeiro.receber" :usaDatas="true" />
            </x-relatorio-card>

            <!-- Relatórios de Cadastros -->
            <x-relatorio-card titulo="Cadastros Auxiliares" cor="purple" icone="table-cells">
                <x-relatorio-item icone="users" texto="Clientes" rota="relatorios.cadastros.clientes" />
                <x-relatorio-item icone="clipboard-document" texto="Famílias de Veículos"
                    rota="relatorios.cadastros.familias" />
                <x-relatorio-item icone="clipboard-document" texto="Opcionais" rota="relatorios.cadastros.opcionais" />
                <x-relatorio-item icone="clipboard-document" texto="Cores" rota="relatorios.cadastros.cores" />
                <x-relatorio-item icone="clipboard-document" texto="Condições de Pagamento"
                    rota="relatorios.cadastros.condicoes" />
            </x-relatorio-card>
        </div>
    </div>


    <div x-data="{ show: false, rota: '', data_inicio: '', data_fim: '' }" x-cloak
        @abrir-modal-relatorio.window="
        show = true;
        rota = $event.detail.rota;
    const today = new Date();
    const start = new Date(today.getFullYear(), today.getMonth(), 1);
    const end = new Date(today.getFullYear(), today.getMonth() + 1, 0);

    data_inicio = start.toISOString().split('T')[0];
    data_fim = end.toISOString().split('T')[0];
    "
        @keydown.escape.window="show = false">
        <div x-show="show" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
            <div class="relative bg-white w-full max-w-md p-6 rounded-lg shadow-xl border-l-4 border-blue-600 animate-fade"
                @click.away="show = false">
                <!-- Ícone decorativo -->
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white p-2 rounded-full shadow">
                    <i class="fas fa-calendar-alt text-blue-600 text-4xl"></i>
                </div>

                <h2 class="text-lg font-bold text-center text-gray-800 mt-6">Selecionar Período</h2>
                <p class="text-sm text-center text-gray-500 mb-4">Informe a data de início e fim do relatório.</p>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Data Início</label>
                        <input type="date" x-model="data_inicio" class="w-full border rounded px-3 py-2 text-sm" />
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Data Fim</label>
                        <input type="date" x-model="data_fim" class="w-full border rounded px-3 py-2 text-sm" />
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button @click="show = false"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm">Cancelar</button>

                    <button
                        @click="
                        if (data_inicio && data_fim) {
                            const url = `${rota}?data_inicio=${data_inicio}&data_fim=${data_fim}`;
                            window.location.href = url;
                        }
                    "
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Gerar
                        Relatório</button>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

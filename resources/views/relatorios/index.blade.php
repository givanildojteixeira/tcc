<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📊 Relatórios do Sistema</h1>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Relatórios Veículos Novos -->
            <x-relatorio-card titulo="Veículos Novos" cor="blue" icone="car">
                <x-relatorio-item icone="clipboard-document" texto="Estoque Atual" rota="relatorios.novos.estoque" />
                <x-relatorio-item icone="clipboard-document" texto="Vendas por Modelo no trimestre" rota="relatorios.novos.vendas" />
            </x-relatorio-card>

            <!-- Relatórios Veículos Usados -->
            <x-relatorio-card titulo="Veículos Usados" cor="yellow" icone="truck">
                <x-relatorio-item icone="clipboard-document" texto="Estoque Atual" rota="relatorios.usados.estoque" />
                <x-relatorio-item icone="clipboard-document" texto="Lucro por Veículo" rota="relatorios.usados.lucro" />
            </x-relatorio-card>

            <!-- Relatórios de Propostas -->
            <x-relatorio-card titulo="Propostas" cor="green" icone="document-text">
                <x-relatorio-item icone="check-badge" texto="Propostas Aprovadas" rota="relatorios.propostas.aprovadas" />
                <x-relatorio-item icone="x-circle" texto="Propostas Rejeitadas" rota="relatorios.propostas.rejeitadas" />
            </x-relatorio-card>

            <!-- Relatórios Financeiros -->
            <x-relatorio-card titulo="Financeiro" cor="red" icone="banknotes">
                <x-relatorio-item icone="clipboard-document" texto="Contas a Pagar" rota="relatorios.financeiro.pagar" />
                <x-relatorio-item icone="clipboard-document" texto="Contas a Receber" rota="relatorios.financeiro.receber" />
            </x-relatorio-card>

            <!-- Relatórios de Cadastros -->
            <x-relatorio-card titulo="Cadastros Auxiliares" cor="purple" icone="table-cells">
                <x-relatorio-item icone="users" texto="Clientes" rota="relatorios.cadastros.clientes" />
                <x-relatorio-item icone="clipboard-document" texto="Famílias de Veículos" rota="relatorios.cadastros.familias" />
                <x-relatorio-item icone="clipboard-document" texto="Opcionais" rota="relatorios.cadastros.opcionais" />
                <x-relatorio-item icone="clipboard-document" texto="Cores" rota="relatorios.cadastros.cores" />
                <x-relatorio-item icone="clipboard-document" texto="Condições de Pagamento" rota="relatorios.cadastros.condicoes" />
            </x-relatorio-card>
        </div>
    </div>
</x-app-layout>

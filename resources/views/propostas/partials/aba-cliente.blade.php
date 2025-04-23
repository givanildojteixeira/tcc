<div x-data="clienteBusca">
    <!-- Campo de busca -->
    <div class="flex gap-4 items-end mb-4">
        <div class="flex flex-col flex-grow">
            <label class="text-sm text-gray-600 font-medium">Buscar Cliente (Nome ou CPF)</label>
            <input type="text" x-model="busca"
                class="border border-gray-300 rounded-md p-2 focus:ring-green-400 focus:outline-none"
                placeholder="Digite parte do nome ou CPF">
        </div>

        <button type="button" @click="buscarClientes"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Localizar Cliente
        </button>
    </div>

    <!-- Lista de clientes encontrados -->
    <template x-if="clientes.length > 0">
        <div class="border border-gray-300 rounded-md p-4 bg-gray-50 mb-4">
            <h3 class="text-green-700 font-semibold mb-2">Clientes Encontrados:</h3>
            <ul class="space-y-1 text-sm text-gray-800">
                <template x-for="cliente in clientes" :key="cliente.id">
                    <li class="flex items-center justify-between border-b border-dashed pb-1">
                        <div>
                            <strong x-text="cliente.nome"></strong>
                            <span class="ml-2 text-gray-500">(CPF: <span x-text="cliente.cpf_cnpj"></span>)</span>
                        </div>
                        <button @click="selecionarCliente(cliente)"
                            class="text-sm text-blue-600 hover:underline">Selecionar</button>
                    </li>
                </template>
            </ul>
        </div>
    </template>

    <!-- Cliente selecionado -->
    <template x-if="clienteSelecionado">
        <div class="border border-green-400 bg-green-50 p-4 rounded-md shadow-sm">
            <h3 class="text-green-800 font-bold mb-2">Cliente Selecionado</h3>
            <ul class="text-sm text-gray-800 space-y-1">
                <li><strong>Nome:</strong> <span x-text="clienteSelecionado.nome"></span></li>
                <li><strong>CPF/CNPJ:</strong> <span x-text="clienteSelecionado.cpf_cnpj"></span></li>
                <li><strong>Email:</strong> <span x-text="clienteSelecionado.email ?? '-'"></span></li>
                <li><strong>Telefone:</strong> <span x-text="clienteSelecionado.celular ?? '-'"></span></li>
            </ul>

            <input type="hidden" name="id_cliente" :value="clienteSelecionado.id">
        </div>
    </template>
</div>

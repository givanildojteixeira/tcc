<div x-data="clienteBusca" x-init="carregarClienteSessao()">
    <!-- Campo de busca -->
    <form @submit.prevent="buscarClientes">
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
            <button type="button" @click="showModalCliente = true"
                class="bg-yellow-400 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                Cadastrar Cliente
            </button>
        </div>
    </form>

    <!-- Lista de clientes encontrados -->
    <template x-if="clientes.length > 0">
        <div class="border border-gray-300 rounded-md p-4 bg-gray-50 mb-4">
            <h3 class="text-green-700 font-semibold mb-2">Clientes Encontrados:</h3>

            <!-- Scroll controlado somente na lista -->
            <div class="max-h-[300px] overflow-y-auto pr-2">
                <ul class="space-y-1 text-sm text-gray-800">
                    <template x-for="cliente in clientes" :key="cliente.id">
                        <li @click="selecionarCliente(cliente)"
                            class="flex items-center justify-between border-b border-dashed pb-1 p-2 rounded cursor-pointer
                                   hover:bg-gray-100 hover:shadow-md active:bg-gray-200 active:shadow-inner transition-all duration-150">
                            <div>
                                <strong x-text="cliente.nome"></strong>
                                <span class="ml-2 text-gray-500">(CPF: <span x-text="cliente.cpf_cnpj"></span>)</span>
                            </div>
                            <span class="text-blue-600 hover:underline text-xs">Selecionar</span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </template>

    <!-- Cliente selecionado -->
    <template x-if="clienteSelecionado">
        <div class="border border-green-400 bg-green-50 p-1 rounded-md shadow-sm">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-lg font-semibold text-green-700">Cliente Selecionado:</h3>
                <button type="button" @click="removerCliente"
                    class="text-red-600 text-sm hover:underline hover:text-red-800">
                    ❌ Remover
                </button>
            </div>
            <ul class="text-sm text-gray-800 space-y-1">
                <li><strong>Nome:</strong> <span x-text="clienteSelecionado.nome"></span>
                    <strong>CPF/CNPJ:</strong> <span x-text="clienteSelecionado.cpf_cnpj"></span>
                </li>
                <li><strong>Email:</strong> <span x-text="clienteSelecionado.email ?? '-'"></span>
                    <strong>Telefone:</strong> <span x-text="clienteSelecionado.celular ?? '-'"></span>
                </li>
                <li><strong>CEP:</strong> <span x-text="clienteSelecionado.cep"></span>
                    <strong>Endereço:</strong> <span x-text="clienteSelecionado.endereco"></span>
                    <strong>Bairro:</strong> <span x-text="clienteSelecionado.bairro"></span>
                    <strong>Cidade:</strong> <span x-text="clienteSelecionado.cidade"></span>
                    <strong>/</strong> <span x-text="clienteSelecionado.uf"></span>
                </li>
            </ul>
            <input type="hidden" name="id_cliente" :value="clienteSelecionado.id">
        </div>
    </template>
    <!-- Modal de Cadastro de Cliente -->
    <div x-show="showModalCliente" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
        style="display: none;">
        <div @click.away="showModalCliente = false" class="bg-white p-6 rounded-lg w-full max-w-3xl shadow-lg">
            @include('clientes.partials.form-create')
        </div>
    </div>

</div>
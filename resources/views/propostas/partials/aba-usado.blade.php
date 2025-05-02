<!-- Controle Alpine -->
<div x-data="veiculoUsado()" x-init="carregarVeiculoViaURL()">

    <!-- Datafield de Inclusão de Veículos Usados -->
    <div class="mb-6">
        <fieldset class="bg-white border border-gray-300 shadow rounded-md p-2">
            <legend class="px-2 text-sm font-bold text-green-700">Inclusão de Veículos Usados</legend>

            <!-- Campo de busca + botões -->
            <div class="flex flex-wrap items-end gap-2 mt-2">

                <!-- Campo de busca -->
                <div class="flex flex-col flex-grow min-w-[220px]">
                    <input type="text" x-model="chassiBusca"
                        class="border border-gray-300 rounded-md p-2 focus:ring-green-400 focus:outline-none"
                        placeholder="Digite parte do chassi, placa ou modelo">
                </div>

                <!-- Botões -->
                <div class="flex gap-2">
                    <button type="button" @click="buscarVeiculoUsado"
                        class="w-36 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        🔍 Localizar
                    </button>

                    <button type="button"
                        @click="window.location.href = '/veiculos/create?from=usados&origem=propostas'"
                        class="w-36 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                        ➕ Cadastrar Novo
                    </button>
                </div>
            </div>

            <!-- Lista de veículos encontrados -->
            <template x-if="Array.isArray(veiculoEncontrado) && veiculoEncontrado.length > 0">
                <div class="bg-gray-50 border border-gray-300 rounded-md p-4 shadow-sm mt-4 max-h-[400px] overflow-y-auto">
                    <h3 class="text-green-700 font-semibold mb-2">Selecione um veículo:</h3>
                    <ul class="space-y-2 text-sm text-gray-800">
                        <template x-for="vu in veiculoEncontrado" :key="vu.id">
                            <li @click="selecionarVeiculo(vu)"
                                class="flex justify-between items-center border-b pb-1 p-2 rounded cursor-pointer
                                       hover:bg-gray-100 hover:shadow-md active:bg-gray-200 active:shadow-inner transition-all duration-150">
                                <div>
                                    <span class="font-semibold" x-text="vu.desc_veiculo"></span> —
                                    <span x-text="vu.chassi"></span> —
                                    <span x-text="vu.cor"></span> —
                                    <span x-text="vu.modelo_fab"></span> —
                                    <span x-text="vu.combustivel"></span> —
                                    <span x-text="vu.transmissao"></span>
                                </div>
                                <span class="text-blue-600 hover:underline text-xs">Selecionar</span>
                            </li>
                        </template>
                    </ul>
                </div>
            </template>
        </fieldset>

        <!-- Dados do veículo selecionado -->
        <template x-if="veiculo && veiculo.id">
            <div class="mt-6 border border-green-400 bg-green-50 p-4 rounded-md shadow-sm">
                <h3 class="text-lg font-semibold text-green-700 mb-2">Veículo Selecionado:</h3>
                <ul class="text-sm text-gray-800 space-y-1">
                    <li><strong>Marca:</strong> <span x-text="veiculo.marca + ' - ' + veiculo.desc_veiculo + ' - ' + veiculo.motor"></span></li>
                    <li><strong>Modelo:</strong> <span x-text="veiculo.modelo_fab"></span>
                        <strong>Opcional:</strong> <span x-text="veiculo.cod_opcional"></span></li>
                    <li><strong>Chassi:</strong> <span x-text="veiculo.chassi"></span></li>
                    <li><strong>Valor Tabela:</strong> <span x-text="veiculo.vlr_tabela"></span></li>
                    <li><strong>Combustível:</strong> <span x-text="veiculo.combustivel"></span></li>
                    <li><strong>Cor:</strong> <span x-text="veiculo.cor"></span></li>
                    <li><strong>Local:</strong> <span x-text="veiculo.local"></span></li>
                    <li><strong>Transmissão:</strong> <span x-text="veiculo.transmissao"></span></li>
                </ul>
                <input type="hidden" name="id_veiculoUsadoSelecionado" :value="veiculo.id">
            </div>
        </template>
    </div>
</div>

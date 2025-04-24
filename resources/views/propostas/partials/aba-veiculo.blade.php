<div x-data="veiculoNovo" x-init="carregarVeiculoPorId()">
    <!-- Campo de busca -->
    <div class="flex gap-4 items-end mb-4">
        <div class="flex flex-col flex-grow">
            <label class="text-sm text-gray-600 font-medium">Buscar por Chassi</label>
            <input type="text" x-model="chassiBusca"
                class="border border-gray-300 rounded-md p-2 focus:ring-green-400 focus:outline-none"
                placeholder="Digite o chassi do veículo novo">
        </div>

        <button type="button" @click="buscarVeiculo"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Localizar Veículo
        </button>
    </div>

    <!-- Lista veículo -->
    <template x-if="veiculos.length > 1">
        <div class="bg-gray-50 border border-gray-300 rounded-md p-4 shadow-sm">
            <h3 class="text-green-700 font-semibold mb-2">Selecione um veículo:</h3>
            <ul class="space-y-2 text-sm text-gray-800">
                <template x-for="v in veiculos" :key="v.id">
                    <li class="flex justify-between items-center border-b pb-1">
                        <div>
                            <span class="font-semibold" x-text="v.modelo"></span> —
                            <span x-text="v.chassi"></span>
                        </div>
                        <button @click="selecionarVeiculo(v)"
                            class="text-blue-600 hover:underline text-xs">Selecionar</button>
                    </li>
                </template>
            </ul>
        </div>
    </template>
    
    <!-- Dados do veículo -->
    <template x-if="veiculo">
        <div class="mt-4 border border-gray-300 bg-white p-4 rounded-md shadow-sm">
            <h3 class="text-lg font-semibold text-green-700 mb-2">Veículo Selecionado:</h3>
            <ul class="text-sm text-gray-800 space-y-1">
                <li><strong>Marca:</strong> <span x-text="veiculo.marca"></span></li>
                <li><strong>Modelo:</strong> <span x-text="veiculo.modelo_fab"></span></li>
                <li><strong>Chassi:</strong> <span x-text="veiculo.chassi"></span></li>
                <li><strong>Ano:</strong> <span x-text="veiculo.ano_fabricacao + '/' + veiculo.ano_modelo"></span></li>
            </ul>
    
            <!-- Input oculto para envio -->
            <input type="hidden" name="id_veiculoNovo" :value="veiculo.id">
        </div>
    </template>
    

</div>
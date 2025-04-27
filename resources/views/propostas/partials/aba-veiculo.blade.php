<div x-data="veiculoNovo" x-init="carregarVeiculoSession()">
    <!-- Campo de busca -->
    <form @submit.prevent="buscarVeiculo">
        <div class="flex gap-4 items-end mb-4">
            <div class="flex flex-col flex-grow">
                <label class="text-sm text-gray-600 font-medium">Buscar por Chassi, Modelo ou Cor</label>
                <input type="text" x-model="chassiBusca"
                    class="border border-gray-300 rounded-md p-2 focus:ring-green-400 focus:outline-none"
                    placeholder="Digite o chassi do veículo novo">
            </div>

            <button type="button" @click="buscarVeiculo"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Localizar Veículo
            </button>
        </div>
    </form>
    <!-- Lista veículo -->
    <template x-if="veiculos.length > 1">
        <div class="bg-gray-50 border border-gray-300 rounded-md p-4 shadow-sm max-h-[400px] overflow-y-auto">
            <h3 class="text-green-700 font-semibold mb-2">Selecione um veículo:</h3>
    
            <ul class="space-y-2 text-sm text-gray-800">
                <template x-for="v in veiculos" :key="v.id">
                    <li @click="selecionarVeiculo(v)"
                        class="flex justify-between items-center border-b pb-1 p-2 rounded cursor-pointer
                               hover:bg-gray-100 hover:shadow-md active:bg-gray-200 active:shadow-inner transition-all duration-150">
                        <div>
                            <span class="font-semibold" x-text="v.desc_veiculo"></span> —
                            <span x-text="v.chassi"></span> —
                            <span x-text="v.cor"></span> —
                            <span x-text="v.chassi"></span> —
                            <span x-text="v.modelo_fab"></span> —
                            <span x-text="v.combustivel"></span> —
                            <span x-text="v.transmissao"></span>
                        </div>
                        <span class="text-blue-600 hover:underline text-xs">Selecionar</span>
                    </li>
                </template>
            </ul>
        </div>
    </template>
    
    
    
    

    <!-- Dados do veículo -->
    <template x-if="veiculo">
        <div class="border border-green-400 bg-green-50 p-4 rounded-md shadow-sm">
            <h3 class="text-lg font-semibold text-green-700 mb-2">Veículo Selecionado:</h3>
            <ul class="text-sm text-gray-800 space-y-1">
                <li><strong>Marca:</strong> <span
                        x-text="veiculo.marca + ' - ' + veiculo.desc_veiculo + ' - ' + veiculo.motor"></span></li>
                <li><strong>Modelo:</strong> <span x-text="veiculo.modelo_fab"></span> <strong>Opcional:</strong> <span
                        x-text="veiculo.cod_opcional"></span></li>
                <li><strong>Chassi:</strong> <span x-text="veiculo.chassi"></span></li>
                <li><strong>Valor Tabela:</strong> <span x-text="veiculo.vlr_tabela"></span></li>
                <li><strong>Combustivel:</strong> <span x-text="veiculo.combustivel"></span></li>
                <li><strong>Cor:</strong> <span x-text="veiculo.cor"></span></li>
                <li><strong>Local:</strong> <span x-text="veiculo.local"></span></li>
                <li><strong>Transmissao:</strong> <span x-text="veiculo.transmissao"></span></li>
            </ul>

            <!-- Input oculto para envio -->
            <input type="hidden" name="id_veiculoNovo" :value="veiculo.id">
        </div>
    </template>


</div>
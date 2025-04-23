<div x-data="veiculoNovo">
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

    <!-- Dados do veículo -->
    <template x-if="veiculo">
        <div class="bg-gray-50 border border-gray-300 rounded-md p-4 shadow-sm">
            <h3 class="text-lg font-semibold text-green-700 mb-2">Veículo Encontrado:</h3>
            <ul class="text-sm text-gray-700 space-y-1">
                <li><strong>Marca:</strong> <span x-text="veiculo.marca"></span></li>
                <li><strong>Modelo:</strong> <span x-text="veiculo.modelo"></span></li>
                <li><strong>Chassi:</strong> <span x-text="veiculo.chassi"></span></li>
                <li><strong>Ano:</strong> <span x-text="veiculo.ano_fabricacao + '/' + veiculo.ano_modelo"></span></li>
            </ul>

            <input type="hidden" name="id_veiculoNovo" :value="veiculo.id">
        </div>
    </template>
</div>

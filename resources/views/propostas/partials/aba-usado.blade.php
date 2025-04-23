<div x-data="veiculoUsado">
    <!-- Seletor: Buscar ou Cadastrar -->
    <div class="mb-4">
        <label class="text-sm font-medium text-gray-700">Deseja cadastrar um novo veículo usado?</label>
        <div class="flex gap-4 mt-2">
            <button type="button" @click="modoCadastro = false"
                :class="!modoCadastro ? 'bg-blue-600 text-white' : 'bg-gray-200'"
                class="px-3 py-1 rounded-md text-sm">Buscar Existente</button>
            <button type="button" @click="modoCadastro = true"
                :class="modoCadastro ? 'bg-green-600 text-white' : 'bg-gray-200'"
                class="px-3 py-1 rounded-md text-sm">Cadastrar Novo</button>
        </div>
    </div>

    <!-- 🔍 Busca veículo usado existente -->
    <div x-show="!modoCadastro" class="mb-4">
        <label class="text-sm font-medium text-gray-700">Buscar por Chassi</label>
        <div class="flex gap-3 mt-1">
            <input type="text" x-model="chassiBusca"
                class="border border-gray-300 rounded-md p-2 flex-grow" placeholder="Digite o chassi">
            <button type="button" @click="buscarVeiculo"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Localizar
            </button>
        </div>

        <template x-if="veiculoEncontrado">
            <div class="mt-4 border border-gray-300 bg-gray-50 p-4 rounded-md">
                <h3 class="text-green-700 font-semibold mb-2">Veículo Encontrado:</h3>
                <ul class="text-sm text-gray-800 space-y-1">
                    <li><strong>Marca:</strong> <span x-text="veiculoEncontrado.marca"></span></li>
                    <li><strong>Modelo:</strong> <span x-text="veiculoEncontrado.modelo"></span></li>
                    <li><strong>Chassi:</strong> <span x-text="veiculoEncontrado.chassi"></span></li>
                </ul>

                <input type="hidden" name="id_veiculoUsado1" :value="veiculoEncontrado.id">
            </div>
        </template>
    </div>

    <!-- 🆕 Cadastro inline de novo usado -->
    <div x-show="modoCadastro" class="space-y-4">
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-700 font-medium">Marca</label>
                <input type="text" name="usado_marca" class="w-full border border-gray-300 rounded-md p-2" required>
            </div>
            <div>
                <label class="text-sm text-gray-700 font-medium">Modelo</label>
                <input type="text" name="usado_modelo" class="w-full border border-gray-300 rounded-md p-2" required>
            </div>
            <div>
                <label class="text-sm text-gray-700 font-medium">Chassi</label>
                <input type="text" name="usado_chassi" class="w-full border border-gray-300 rounded-md p-2" required>
            </div>
            <div>
                <label class="text-sm text-gray-700 font-medium">Ano</label>
                <input type="text" name="usado_ano" class="w-full border border-gray-300 rounded-md p-2">
            </div>
        </div>
        <p class="text-sm text-gray-500 italic">O veículo será salvo automaticamente caso a proposta seja finalizada com sucesso.</p>
    </div>
</div>

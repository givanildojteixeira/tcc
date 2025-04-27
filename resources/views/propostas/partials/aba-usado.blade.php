<!-- Controle Alpine -->
{{-- <div x-data="{ modoCadastro: false, modalCadastroUsado: false }">   --}}
    <div x-data="veiculoUsado()" x-init>

    <!-- Botões Buscar ou Cadastrar Novo -->
    <div class="mb-4">
        <div class="flex gap-4 mt-2">
            <button type="button" @click="modoCadastro = false"
                :class="!modoCadastro ? 'bg-blue-600 text-white' : 'bg-gray-200'"
                class="px-3 py-1 rounded-md text-sm">Buscar Existente</button>

            <button type="button" @click="modalCadastroUsado = true"
                class="px-3 py-1 rounded-md text-sm bg-green-600 text-white hover:bg-green-700 transition">
                Cadastrar Novo
            </button>
        </div>
    </div>

    <!-- 🔍 Busca de Veículo Usado Existente -->
    <div x-show="!modoCadastro" class="mb-4">
        <label class="text-sm font-medium text-gray-700">Buscar por Chassi</label>
        <div class="flex gap-3 mt-1">
            <input type="text" x-model="chassiBusca" class="border border-gray-300 rounded-md p-2 flex-grow"
                placeholder="Digite o chassi">
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

    <!-- 🌟 Modal Cadastro Novo Veículo Usado -->
    <div x-show="modalCadastroUsado" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        style="display: none;">
        <div @click.away="modalCadastroUsado = false"
            class="bg-white p-6 rounded-lg w-full max-w-4xl overflow-y-auto max-h-[90vh] shadow-xl">
            <h2 class="text-2xl font-semibold text-green-700 mb-6">Cadastrar Veículo Usado</h2>

            <!-- Formulário Cadastro Novo -->
            <div class="space-y-4">
                <div class="flex flex-wrap gap-4 mb-4">

                    <div class="basis-[20%] flex-grow min-w-[250px]">
                        <label class="block text-gray-700 font-medium mb-1">Modelo do Veículo</label>
                        <input type="text" name="desc_veiculo" value="{{ old('desc_veiculo') }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <div class="basis-[20%] flex-grow min-w-[180px]">
                        <label class="block text-gray-700 font-medium mb-1">Chassi</label>
                        <input type="text" name="chassi" value="{{ old('chassi') }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>
                    <x-input-moeda name="vlr_nota" label="Valor da Avaliação" />
                </div>

                <div class="flex flex-wrap gap-4 mb-4">
                    <div class="flex-grow basis-[10%] min-w-[80px]">
                        <label class="block text-gray-700 font-medium mb-1">Ano/Modelo</label>
                        <input type="text" name="Ano_Mod" value="{{ old('Ano_Mod') }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <div class="flex-grow basis-[25%] min-w-[150px]">
                        <label class="block text-gray-700 font-medium mb-1">Cor</label>
                        <input type="text" name="cor" value="{{ old('cor') }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <div class="flex-grow basis-[5%] min-w-[60px]">
                        <label class="block text-gray-700 font-medium mb-1">Motor</label>
                        <input type="text" name="motor" value="{{ old('motor') }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <div class="basis-[5%] min-w-[60px]">
                        <label class="block text-gray-700 font-medium mb-1">Portas</label>
                        <input type="number" name="portas" value="{{ old('portas') }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 text-center focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <div class="flex-grow basis-[10%] min-w-[60px]">
                        <label class="block text-gray-700 font-medium mb-1">Combustível</label>
                        <select name="combustivel"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            @foreach (['Gasolina', 'Etanol', 'Diesel', 'Flex'] as $comb)
                            <option value="{{ $comb }}" {{ old('combustivel')==$comb ? 'selected' : '' }}>{{ $comb }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="local" class="block text-gray-700 font-medium mb-1">Local</label>
                        <select name="local" id="local" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            <option value="matriz" {{ old('local')=='matriz' ? 'selected' : '' }}>Matriz</option>
                            <option value="filial" {{ old('local')=='filial' ? 'selected' : '' }}>Filial</option>
                            <option value="consignado" {{ old('local')=='consignado' ? 'selected' : '' }}>Consignado
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="descricao" class="block text-sm font-medium text-gray-700">Opcionais e Observações</label>
                    <textarea x-model="novoUsado.descricao" rows="6"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-400 focus:border-blue-400"></textarea>
                </div>

                <!-- Botões -->
                <div class="flex justify-between items-center mt-6">
                    <button type="button" @click="modalCadastroUsado = false"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md">
                        Cancelar
                    </button>
                    <button type="button" @click="cadastrarVeiculoUsado()"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md">
                        Cadastrar
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
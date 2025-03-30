<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">

        <!-- Título -->
        <h2 class="text-2xl font-semibold text-blue-600 mb-6 text-center">Editar Veículo</h2>

        <!-- Formulário -->
        <form method="POST" action="{{ route('veiculos.update', $veiculo->id) }}" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Família -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Família</label>
                    <input type="text" name="familia" value="{{ old('familia', $veiculo->familia) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Descrição do Veículo -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Descrição do Veículo</label>
                    <input type="text" name="desc_veiculo" value="{{ old('desc_veiculo', $veiculo->desc_veiculo) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Modelo de Fabricação -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Modelo de Fabricação</label>
                    <input type="text" name="modelo_fab" value="{{ old('modelo_fab', $veiculo->modelo_fab) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Combustível -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Combustível</label>
                    <select name="combustivel"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">Selecione</option>
                        <option value="Gasolina"
                            {{ old('combustivel', $veiculo->combustivel) == 'Gasolina' ? 'selected' : '' }}>Gasolina
                        </option>
                        <option value="Etanol"
                            {{ old('combustivel', $veiculo->combustivel) == 'Etanol' ? 'selected' : '' }}>Etanol
                        </option>
                        <option value="Diesel"
                            {{ old('combustivel', $veiculo->combustivel) == 'Diesel' ? 'selected' : '' }}>Diesel
                        </option>
                        <option value="Flex"
                            {{ old('combustivel', $veiculo->combustivel) == 'Flex' ? 'selected' : '' }}>Flex</option>
                    </select>
                </div>

                <!-- Ano/Modelo -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Ano/Modelo</label>
                    <input type="text" name="Ano_Mod" value="{{ old('Ano_Mod', $veiculo->Ano_Mod) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Chassi -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Chassi</label>
                    <input type="text" name="chassi" value="{{ old('chassi', $veiculo->chassi) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Cor -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Cor</label>
                    <input type="text" name="cor" value="{{ old('cor', $veiculo->cor) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Portas -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Portas</label>
                    <input type="number" name="portas" value="{{ old('portas', $veiculo->portas) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Opcionais -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-1">Opcionais</label>
                    <textarea name="cod_opcional" rows="3"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('cod_opcional', $veiculo->cod_opcional) }}</textarea>
                </div>

                <!-- Tabela, Bônus, Custo -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Valor Tabela</label>
                    <input type="text" name="vlr_tabela" value="{{ old('vlr_tabela', $veiculo->vlr_tabela) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Valor Bônus</label>
                    <input type="text" name="vlr_bonus" value="{{ old('vlr_bonus', $veiculo->vlr_bonus) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Valor Custo</label>
                    <input type="text" name="vlr_nota" value="{{ old('vlr_nota', $veiculo->vlr_nota) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
            </div>

            <!--Botões -->            TODO:   BOTAO CANCELAR PODE VOLTAR ERRADO PARA NOVOS SEMPRE
            <div class="flex justify-between mt-8">
                <a href="{{ route('veiculos.novos.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-2 rounded-md">
                    Cancelar
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-md shadow-md">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

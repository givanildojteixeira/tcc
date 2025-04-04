<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <!-- Título com botão de ajuda ao lado direito -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-blue-600">Alterar informações do Veículo</h2>

            <!-- Botão de Ajuda -->
            <button onclick="document.getElementById('modalAjuda').classList.remove('hidden')"
                class="text-blue-600 hover:text-blue-800 text-2xl" title="Ajuda">
                <i class="fas fa-circle-info"></i>
            </button>
        </div>


        <!-- Formulário -->
        <form method="POST" action="{{ route('veiculos.update', $veiculo->id) }}" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="border border-green-500 rounded-xl p-6 mb-6 shadow-sm bg-white">
                <div class="flex flex-wrap gap-4 mb-4">
                    <!-- Família -->
                    <div class="basis-[20%] flex-grow min-w-[150px]">
                        <label class="block text-gray-700 font-medium mb-1">Família</label>
                        <select name="familia"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <option value="">Selecione uma família</option>
                            @foreach ($familias as $familia)
                                <option value="{{ $familia->descricao }}"
                                    {{ old('familia', $veiculo->familia) == $familia->descricao ? 'selected' : '' }}>
                                    {{ $familia->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Descrição do Veículo (mais largo) -->

                    <div class="basis-[40%] flex-grow min-w-[250px]">
                        <label class="block text-gray-700 font-medium mb-1">Descrição do Veículo</label>
                        <input type="text" name="desc_veiculo"
                            value="{{ old('desc_veiculo', $veiculo->desc_veiculo) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <!-- Chassi -->
                    <div class="basis-[20%] flex-grow min-w-[180px]">
                        <label class="block text-gray-700 font-medium mb-1">Chassi</label>
                        <input type="text" name="chassi" value="{{ old('chassi', $veiculo->chassi) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <!-- Modelo de Fabricação -->
                    <div class="basis-[10%] flex-grow min-w-[100px]">
                        <label class="block text-gray-700 font-medium mb-1">Fabricação</label>
                        <input type="text" name="modelo_fab" value="{{ old('modelo_fab', $veiculo->modelo_fab) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>
                </div>


                <div class="flex flex-wrap gap-4 mb-4">
                    <!-- Ano/Modelo -->
                    <div class="flex-grow basis-[15%] min-w-[150px]">
                        <label class="block text-gray-700 font-medium mb-1">Ano/Modelo</label>
                        <input type="text" name="Ano_Mod" value="{{ old('Ano_Mod', $veiculo->Ano_Mod) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <!-- Cor -->
                    <div class="flex-grow basis-[25%] min-w-[150px]">
                        <label class="block text-gray-700 font-medium mb-1">Cor</label>
                        <input type="text" name="cor" value="{{ old('cor', $veiculo->cor) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <!-- Portas (campo pequeno) -->
                    <div class="basis-[10%] min-w-[80px]">
                        <label class="block text-gray-700 font-medium mb-1">Portas</label>
                        <input type="number" name="portas" value="{{ old('portas', $veiculo->portas) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 text-center focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <!-- Combustível (campo maior) -->
                    <div class="flex-grow basis-[25%] min-w-[200px]">
                        <label class="block text-gray-700 font-medium mb-1">Combustível</label>
                        <select name="combustivel"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <option value="Gasolina"
                                {{ old('combustivel', $veiculo->combustivel) == 'Gasolina' ? 'selected' : '' }}>
                                Gasolina
                            </option>
                            <option value="Etanol"
                                {{ old('combustivel', $veiculo->combustivel) == 'Etanol' ? 'selected' : '' }}>Etanol
                            </option>
                            <option value="Diesel"
                                {{ old('combustivel', $veiculo->combustivel) == 'Diesel' ? 'selected' : '' }}>Diesel
                            </option>
                            <option value="Flex"
                                {{ old('combustivel', $veiculo->combustivel) == 'Flex' ? 'selected' : '' }}>Flex
                            </option>
                        </select>
                    </div>

                    <!-- Opcionais -->
                    <div class="basis-[15%] min-w-[80px]">
                        <label class="block text-gray-700 font-medium mb-1">Opcional</label>
                        <input type="text" name="cod_opcional"
                            value="{{ old('cod_opcional', $veiculo->cod_opcional) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>
                </div>
                <!-- Linha com Valor Tabela, Bônus e Custo -->
                @php
                    $valor = old('vlr_tabela', $veiculo->vlr_nota);
                    $valor_f_nota = number_format($valor, 2, ',', '.');
                    $valor = old('vlr_tabela', $veiculo->vlr_bonus);
                    $valor_f_bonus = number_format($valor, 2, ',', '.');
                    $valor = old('vlr_tabela', $veiculo->vlr_tabela);
                    $valor_f_tabela = number_format($valor, 2, ',', '.');
                @endphp
                <div class="flex flex-row gap-4 mb-4 ">
                    <div class="w-1/3">
                        <label class="block text-gray-700 font-medium mb-1">Valor Custo</label>
                        <input type="text" name="vlr_nota" id="vlr_nota"
                            value="{{ old('vlr_nota', $valor_f_nota) }}"
                            class="w-full text-right border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
                    </div>
                    <div class="w-1/3">
                        <label class="block text-gray-700 font-medium mb-1">Valor Bônus</label>
                        <input type="text" name="vlr_bonus" id="vlr_bonus"
                            value="{{ old('vlr_bonus', $valor_f_bonus) }}"
                            class="w-full text-right border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
                    </div>

                    <div class="w-1/3">
                        <label class="block text-gray-700 font-medium mb-1">Valor Tabela</label>
                        <input type="text" name="vlr_tabela" id="vlr_tabela"
                            value="{{ old('vlr_tabela', $valor_f_tabela) }}"
                            class="w-full text-right border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
                    </div>
                </div>
            </div>



            <!--Botões -->
            <div class="flex flex-wrap gap-4 justify-between mt-8">
                <!-- Voltar -->
                @if (request('from') === 'novos')
                    <a href="{{ route('veiculos.novos.index') }}"
                        class="flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-2 rounded-md shadow-md transition">
                        <i class="fas fa-times-circle"></i>
                        Voltar
                    </a>
                @elseif(request('from') === 'usados')
                    <a href="{{ route('veiculos.usados.index') }}"
                        class="flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-2 rounded-md shadow-md transition">
                        <i class="fas fa-times-circle"></i>
                        Voltar
                    </a>
                @endif


                <!-- Cadastro Famílias -->
                <a href="{{ route('familia.index', ['from' => $veiculo->id]) }}"
                    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2 rounded-md shadow-md transition">
                    <i class="fas fa-users"></i>
                    Cadastro Famílias
                </a>

                <!-- Cadastro Descrição Opcionais -->
                <button type="button"
                    class="flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-6 py-2 rounded-md shadow-md transition">
                    <i class="fas fa-list"></i>
                    Cadastro Opcionais
                </button>

                <!-- Salvar Alterações -->
                <button type="submit"
                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-md shadow-md transition">
                    <i class="fas fa-save"></i>
                    Salvar Alterações
                </button>
            </div>

        </form>
    </div>


    <!-- Modal de Ajuda -->
    <div id="modalAjuda" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
            <h3 class="text-xl font-semibold text-blue-600 mb-4">Ajuda - Edição de Veículo</h3>
            <p class="text-gray-700 mb-4">
                Nesta tela você pode editar as informações principais de um veículo, como família, descrição,
                chassi, ano/modelo, valores e mais. Certifique-se de preencher corretamente os campos obrigatórios e
                clique em "Salvar Alterações".
            </p>
            <div class="flex justify-end">
                <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Fechar
                </button>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/imask"></script>
    <script>
        const moedaMaskOptions = {
            mask: 'R$ num',
            blocks: {
                num: {
                    mask: Number,
                    thousandsSeparator: '.',
                    radix: ',',
                    scale: 2,
                    signed: false,
                    padFractionalZeros: true,
                    normalizeZeros: true
                }
            }
        };

        IMask(document.getElementById('vlr_tabela'), moedaMaskOptions);
        IMask(document.getElementById('vlr_bonus'), moedaMaskOptions);
        IMask(document.getElementById('vlr_nota'), moedaMaskOptions);
    </script>


</x-app-layout>

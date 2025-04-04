<x-app-layout> {{--  ✅  Alterar informações do Veículo -  EDIT  - INDEX  - VEICULOS - GENERICOS --}}
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <!-- Título com botão de ajuda ao lado direito -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-blue-600">Alterar informações do Veículo</h2>
            <x-bt-ajuda /> <!-- Botão de Ajuda -->
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

                <!-- Ano modelo , Cor, portas  Combustivel, Opcional -->
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
                <div class="flex flex-row gap-4 mb-4 ">
                    <x-input-moeda name="vlr_nota" label="Valor Custo" :value="$veiculo->vlr_nota" />
                    <x-input-moeda name="vlr_bonus" label="Valor Bônus" :value="$veiculo->vlr_bonus" />
                    <x-input-moeda name="vlr_tabela" label="Valor Tabela" :value="$veiculo->vlr_tabela" />
                </div>

                <!-- Upload de Imagens do Veículo -->
                <div class="flex flex-wrap md:flex-nowrap gap-6 mt-6">
                    <!-- Upload -->
                    <div class="md:w-1/3 w-full">
                        <label class="block text-gray-700 font-medium mb-1">Imagens do Veículo (até 10 - apenas
                            .jpg)</label>
                        <input type="file" name="images[]" accept=".jpg" multiple
                            class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                   file:rounded-md file:border-0 file:text-sm file:font-semibold
                   file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
                        <p class="text-xs text-gray-500 mt-1">Nomes: chassi_01.jpg, chassi_02.jpg, ...</p>
                    </div>

                    <!-- Visualização -->
                    @php
                        $images = [];
                        $chassiBase = str_replace(' ', '_', $veiculo->chassi);
                        for ($i = 1; $i <= 10; $i++) {
                            $nome = "{$chassiBase}_" . str_pad($i, 2, '0', STR_PAD_LEFT) . '.jpg';
                            if (file_exists(public_path("images/cars/$nome"))) {
                                $imagens[] = asset("images/cars/$nome");
                            }
                        }
                    @endphp

                    @if (count($imagens))
                        <div class="md:w-2/3 w-full">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($imagens as $img)
                                    @php
                                        $nomeArquivo = basename($img);
                                    @endphp

                                    <div class="flex flex-col items-center">
                                        <div class="flex flex-col items-center">
                                            <img src="{{ $img }}" alt="Imagem do veículo"
                                                class="w-16 h-16 object-cover rounded shadow border border-gray-300">

                                            <button type="button"
                                                onclick="excluirImagem('{{ $nomeArquivo }}', this)"
                                                class="text-red-600 hover:text-red-800 text-sm mt-1"
                                                title="Excluir imagem">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif
                </div>


            </div>


            <!--Botões -->

            <div class="flex flex-wrap gap-4 justify-between mt-8">
                {{-- Oculto para quando salvar recuperar a url --}}
                @if (request('from'))
                    <input type="hidden" name="from" value="{{ request('from') }}">
                @endif

                <!-- Voltar -->
                @if (request('from') === 'novos')
                    <a href="{{ route('veiculos.novos.index') }}"
                        class="flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-2 rounded-md shadow-md transition"
                        data-atalho="voltar">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                @elseif(request('from') === 'usados')
                    <a href="{{ route('veiculos.usados.index') }}"
                        class="flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-2 rounded-md shadow-md transition"
                        data-atalho="voltar">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                @endif


                <!-- Cadastro Famílias -->
                <a href="{{ route('familia.index', ['from' => $veiculo->id, 'origem' => request('from')]) }}"
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
                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-md shadow-md transition"
                    data-atalho="salvar">
                    <i class="fas fa-save"></i>
                    Salvar Alterações
                </button>
            </div>

        </form>
    </div>


    <!-- Modal de Ajuda -->
    <div id="modalAjuda" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full p-6 relative flex gap-6">

            <!-- Ícone de Informação à esquerda -->
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 text-6xl"></i>
            </div>

            <!-- Conteúdo do Modal -->
            <div class="flex-1 relative">
                <!-- Botão de Fechar -->
                <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                    class="absolute top-0 right-0 text-red-500 hover:text-red-700 text-2xl">
                    &times;
                </button>

                <h2 class="text-2xl font-bold text-blue-600 mb-4">Instruções para Alterar informações do Veículo</h2>

                <p class="mb-3 text-sm text-gray-700 leading-relaxed">
                    Esta tela tem como objetivo <strong>editar ou excluir </strong> um veículo cadastrado no sistema.
                    Utilize os recursos abaixo para uma busca eficaz:
                </p>

                <ul class="list-disc list-inside text-sm text-gray-800 space-y-2">
                    <li><strong>Família:</strong> Caso nao encontre a familia correta, pode cadastrar atraves do botao
                        Cadastro de Familia</li>
                    <li><strong>Opcional:Novos</strong>É um codigo que será combinado com o Cod de Fabricao para ligar
                        um opcional da familia ao veiculo</li>
                    <li><strong>Opcional:Usados</strong>Será descritivo e vinculado ao chassis do veiculo</li>

                </ul>

                <div class="mt-6 text-right">
                    <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                        class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                        Entendi!
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function excluirImagem(nomeArquivo, botao) {
            if (!confirm('Deseja realmente excluir esta imagem?')) return;

            fetch("{{ route('veiculos.imagem.excluir') }}", {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ imagem: nomeArquivo })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Remove o contêiner da imagem
                    const container = botao.closest('.flex-col');
                    container.remove();
                    window.mostrarToast?.('Imagem excluída com sucesso!');
                } else {
                    alert('Erro ao excluir a imagem.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Erro ao excluir a imagem.');
            });
        }
    </script>




</x-app-layout>

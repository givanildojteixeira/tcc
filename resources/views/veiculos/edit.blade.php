<x-app-layout> {{-- ✅  Alterar informações do Veículo -  EDIT  - INDEX  - VEICULOS - GENERICOS --}}
    <div x-data="{ tabAtiva: 'info' }" class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <!-- Título com botão de ajuda ao lado direito -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-blue-600">Alterar informações do Veículo</h2>
            <x-bt-ajuda /> <!-- Botão de Ajuda -->
        </div>
        {{-- Oculto para quando salvar recuperar a url --}}
        @if (request('from'))
            <input type="hidden" name="from" value="{{ request('from') }}">
        @endif
        <!-- Abas -->
        <div class="flex bg-gray-100 rounded-md overflow-hidden shadow-sm mb-6 font-bold">
            <button @click="tabAtiva = 'info'"
                :class="tabAtiva === 'info'
                    ?
                    'bg-blue-100 text-blue-700 font-semibold shadow-inner' :
                    'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 text-sm transition-all duration-200"><i class="fas fa-car"></i>
                Informações do Veículo
            </button>
            <button @click="tabAtiva = 'fotos'"
                :class="tabAtiva === 'fotos'
                    ?
                    'bg-blue-100 text-blue-700 font-semibold shadow-inner' :
                    'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 text-sm transition-all duration-200"><i class="fas fa-image"></i>
                Imagens do Veículo
            </button>

            <button @click="tabAtiva = 'opcionais'"
                :class="tabAtiva === 'opcionais'
                    ?
                    'bg-blue-100 text-blue-700 font-semibold shadow-inner' :
                    'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 text-sm transition-all duration-200"><i class="fas fa-cogs"></i>
                Opcionais do Veículo
            </button>
        </div>

        <!-- Formulário -->
        <form method="POST" action="{{ route('veiculos.update', $veiculo->id) }}" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')
            <!-- Instrução para apos PUT, voltar para a origem correta (from) -->
            @if (request('from'))
                <input type="hidden" name="from" value="{{ request('from') }}">
            @endif


            <div x-show="tabAtiva === 'info'">
                <div class="border border-green-500 rounded-xl p-6 mb-6 shadow-sm bg-white">
                    <div class="flex flex-wrap gap-4 mb-4">
                        @if (request('from') === 'novos')
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
                        @endif

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
                        @if (request('from') === 'novos')
                            <!-- Modelo de Fabricação -->
                            <div class="basis-[10%] flex-grow min-w-[100px]">
                                <label class="block text-gray-700 font-medium mb-1">Fabricação</label>
                                <input type="text" name="modelo_fab"
                                    value="{{ old('modelo_fab', $veiculo->modelo_fab) }}"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            </div>
                        @endif
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
                        <div class="basis-[8%] min-w-[60px]">
                            <label class="block text-gray-700 font-medium mb-1">Portas</label>
                            <input type="number" name="portas" value="{{ old('portas', $veiculo->portas) }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 text-center focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        </div>

                        <!-- Combustível () -->
                        <div class="flex-grow basis-[10%] min-w-[80px]">
                            <label class="block text-gray-700 font-medium mb-1">Combustível</label>
                            <select name="combustivel"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="Gasolina"
                                    {{ old('combustivel', $veiculo->combustivel) == 'Gasolina' ? 'selected' : '' }}>
                                    Gasolina
                                </option>
                                <option value="Etanol"
                                    {{ old('combustivel', $veiculo->combustivel) == 'Etanol' ? 'selected' : '' }}>
                                    Etanol
                                </option>
                                <option value="Diesel"
                                    {{ old('combustivel', $veiculo->combustivel) == 'Diesel' ? 'selected' : '' }}>
                                    Diesel
                                </option>
                                <option value="Flex"
                                    {{ old('combustivel', $veiculo->combustivel) == 'Flex' ? 'selected' : '' }}>Flex
                                </option>
                            </select>
                        </div>

                        <!-- Tramsmissao (campo maior) -->
                        <div class="flex-grow basis-[14%] min-w-[100px]">
                            <label class="block text-gray-700 font-medium mb-1">Transmissão</label>
                            <select name="transmissao"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="Mecanica"
                                    {{ old('transmissao', $veiculo->transmissao) == 'Mecanica' ? 'selected' : '' }}>
                                    Mecânica
                                </option>
                                <option value="Automatica"
                                    {{ old('transmissao', $veiculo->transmissao) == 'Automatica' ? 'selected' : '' }}>
                                    Automática
                                </option>
                            </select>
                        </div>

                        @if (request('from') === 'novos')
                            <!-- Opcionais -->
                            <div class="basis-[10%] min-w-[80px]">
                                <label class="block text-gray-700 font-medium mb-1">Opcional</label>
                                <input type="text" name="cod_opcional"
                                    value="{{ old('cod_opcional', $veiculo->cod_opcional) }}"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            </div>
                        @endif
                    </div>

                    <!-- Linha com Valor Tabela, Bônus e Custo -->
                    <div class="flex flex-row gap-4 mb-4 ">
                        <x-input-moeda name="vlr_nota" label="Valor Custo" :value="$veiculo->vlr_nota" />
                        <x-input-moeda name="vlr_bonus" label="Valor Bônus" :value="$veiculo->vlr_bonus" />
                        <x-input-moeda name="vlr_tabela" label="Valor Tabela" :value="$veiculo->vlr_tabela" />
                        <div class="mb-4">
                            <label for="local" class="block text-gray-700 font-medium mb-1">Local</label>
                            <select name="local" id="local" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                <option value="{{ old('local', $veiculo->local) }}"></option>

                                @if (request('from') === 'novos')
                                    <option value="Matriz"
                                        {{ old('local', $veiculo->local) == 'Matriz' ? 'selected' : '' }}>Matriz
                                    </option>
                                    <option value="Filial"
                                        {{ old('local', $veiculo->local) == 'Filial' ? 'selected' : '' }}>Filial
                                    </option>
                                    <option value="Transito"
                                        {{ old('local', $veiculo->local) == 'Transito' ? 'selected' : '' }}>Trânsito
                                    </option>
                                @else
                                    <option value="Matriz"
                                        {{ old('local', $veiculo->local) == 'Matriz' ? 'selected' : '' }}>Matriz
                                    </option>
                                    <option value="Filial"
                                        {{ old('local', $veiculo->local) == 'Filial' ? 'selected' : '' }}>Filial
                                    </option>
                                    <option value="Consignado"
                                        {{ old('local', $veiculo->local) == 'Consignado' ? 'selected' : '' }}>
                                        Consignado</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end items-center gap-4 mb-2 mt-[-8px]">
                        <!-- Ativo -->
                        <x-veiculo-switch :veiculo="$veiculo" campo="ativo" label="Disponível para venda" />

                        <!-- Promoção -->
                        <x-veiculo-switch :veiculo="$veiculo" campo="promocao" label="Veículo em promoção" />
                    </div>
                </div>
            </div>
            <div x-show="tabAtiva === 'fotos'"> <!-- Upload de Imagens do Veículo -->
                <div class="border border-green-500 rounded-xl p-6 mb-6 shadow-sm bg-white">
                    <div class="flex flex-wrap md:flex-nowrap gap-6">
                        <!-- Upload -->
                        <div class="md:w-1/3 w-full">
                            <label class="block text-gray-700 font-medium mb-1">
                                Imagens do Veículo (até 10 - apenas .jpg)
                            </label>
                            <input type="file" name="images[]" accept=".jpg" multiple
                                class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                       file:rounded-md file:border-0 file:text-sm file:font-semibold
                       file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
                        </div>

                        <!-- Visualização -->
                        @php
                            $imagens = [];
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
                                <label class="block text-gray-700 font-medium mb-1">Imagens Gravadas:</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($imagens as $img)
                                        @php
                                            $nomeArquivo = basename($img);
                                        @endphp

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
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div x-show="tabAtiva === 'opcionais'">
                <div class="border border-green-500 rounded-xl p-6 mb-6 shadow-sm bg-white">
                    <div class="flex flex-wrap gap-4">
                        @if (request('from') === 'novos')
                            <div class="flex flex-col md:flex-row gap-6 w-full">
                                <!-- Coluna esquerda com os campos empilhados -->
                                <div class="flex flex-col gap-4 w-full md:w-[280px]">
                                    <!-- Modelo/Fab -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Modelo/Fab</label>
                                        <input disabled type="text" name="modelo_fab"
                                            value="{{ old('modelo_fab', $veiculo->modelo_fab) }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                    </div>

                                    <!-- Código do Opcional -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Código do
                                            Opcional</label>
                                        <input disabled type="text" name="cod_opcional"
                                            value="{{ old('cod_opcional', $veiculo->cod_opcional) }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                    </div>
                                </div>

                                <!-- Coluna direita com textarea -->
                                <div class="w-full md:flex-1 mb-4">
                                    <label for="descricao"
                                        class="block text-sm font-medium text-gray-700">Descrição</label>

                                    <textarea name="descricao" id="descricao" rows="6" maxlength="5000"
                                        class="mt-1 block w-full h-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ implode("\n", array_map('trim', explode('/', $opcionalDescricao))) }}</textarea>
                                </div>
                            </div>
                        @elseif(request('from') === 'usados')
                            <div class="flex-1 basis-[30%] min-w-[120px]">
                                <label class="block text-gray-700 font-medium mb-1">Chassi</label>
                                <input disabled type="text" name="chassi"
                                    value="{{ old('chassi', $veiculo->chassi) }}"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            </div>
                            <!-- Coluna direita com textarea -->
                            <div class="flex-1 basis-[65%] min-w-[200px] mb-6">
                                <label for="descricao"
                                    class="block text-sm font-medium text-gray-700">Descrição</label>
                                <textarea name="descricao" id="descricao" rows="6" maxlength="5000"
                                    class="mt-1 block w-full h-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ implode("\n", array_map('trim', explode('/', $opcionalDescricao))) }}</textarea>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
            <!--Botões -->

            <div class="flex flex-wrap gap-4 justify-between mt-8 items-center">

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

                <!-- Salvar Alterações -->
                <button type="submit"
                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-md shadow-md transition"
                    data-atalho="salvar">
                    <i class="fas fa-save"></i>
                    Salvar Alterações
                </button>
            </form>

            <!-- Excluir Veículo -->
            <form method="POST" action="{{ route('veiculos.destroy', $veiculo->id) }}"
                onsubmit="return confirm('Tem certeza que deseja excluir este veículo? Esta ação não pode ser desfeita!')">
                @csrf
                @method('DELETE')
                <!-- Instrução para apos PUT, voltar para a origem correta (from) -->
                @if (request('from'))
                    <input type="hidden" name="from" value="{{ request('from') }}">
                @endif
                <button type="submit"
                    class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-2 rounded-md shadow-md transition">
                    <i class="fas fa-trash-alt"></i>
                    Excluir Veículo
                </button>
            </form>
        </div>
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
                    <li><strong>Aba:Imagens do Veículo:</strong> É possivel inserir ate 10 imagens no formato jpeg que
                        ficarao visiveis
                        na tela de Detalhes do Veículo</li>
                    <li><strong>Aba: Opcionais do Veiculo:</strong> Insira os opcionais do veiculo, separando por quebra
                        de linha para facilitar
                        a visibilidade na tela de Detalhes do Veículo</li>

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
                    body: JSON.stringify({
                        imagem: nomeArquivo
                    })
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


        function alterarStatusVeiculo(id, campo, valor) {
            fetch(`/veiculos/status/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        campo: campo,
                        valor: valor
                    })
                })
                .then(response => response.json())
                .then(data => {
                    window.mostrarToast?.(`Campo "${data.campo}" atualizado com sucesso!`);
                })
                .catch(error => {
                    alert('Erro ao atualizar o status do veículo.');
                    console.error(error);
                });
        }
    </script>




</x-app-layout>

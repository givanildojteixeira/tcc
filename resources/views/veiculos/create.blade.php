<x-app-layout> {{-- Criação de veiculos NOVOS e USADOS --}}
    <div x-data="{
        tabAtiva: localStorage.getItem('aba_veiculo') || 'info',
        modelo_fab: '{{ old('modelo_fab') }}',
        cod_opcional: '{{ old('cod_opcional') }}',

        setTab(tab) {
            this.tabAtiva = tab;
            localStorage.setItem('aba_veiculo', tab);
            this.$nextTick(() => {
                const primeiroCampo = this.$refs[tab + '_first'];
                if (primeiroCampo) primeiroCampo.focus();
            });
        }
    }" x-init="$nextTick(() => {
        const tab = tabAtiva;
        const primeiroCampo = $refs[tab + '_first'];
        if (primeiroCampo) primeiroCampo.focus();

        @if(session('success'))
            localStorage.removeItem('aba_veiculo');
        @endif
    })" class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <div class="overflow-y-auto max-h-[calc(100vh-100px)] pr-1">
            <!-- Título -->
            <div class="flex items-center justify-between mb-6">
                @if (request('from') === 'novos')
                    <h2 class="text-2xl font-semibold text-blue-600">Cadastrar Veículo Novo</h2>
                @else
                    @if (request('origem') === 'propostas')
                        <h2 class="text-2xl font-semibold text-blue-600">Cadastrar Veículo Usado*</h2>
                    @else
                        <h2 class="text-2xl font-semibold text-blue-600">Cadastrar Veículo Usado</h2>
                    @endif
                @endif
                <x-bt-ajuda />
            </div>

            <!-- Formulário -->
            <form method="POST" action="{{ route('veiculos.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                @if (request('from'))
                    <input type="hidden" name="from" value="{{ request('from') }}">
                @endif
                @if (request('origem'))
                    <input type="hidden" name="origem" value="{{ request('origem') }}">
                @endif

                <!-- Abas -->
                <div class="flex bg-gray-100 rounded-md overflow-hidden shadow-sm mb-6 font-bold">
                    <button type="button" @click="setTab('info')" :class="tabAtiva === 'info' ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner' :
        'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                        class="flex-1 px-4 py-2 text-sm transition-all duration-200">
                        <i class="fas fa-car"></i> Informações do Veículo
                    </button>
                    <button type="button" @click="setTab('fotos')" :class="tabAtiva === 'fotos' ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner' :
        'text-gray-600 hover:bg-gray-200 hover:text-gray-800'" class="flex-1 px-4 py-2 text-sm transition-all duration-200">
                        <i class="fas fa-image"></i> Imagens do Veículo
                    </button>
                    <button type="button" @click="setTab('opcionais')" :class="tabAtiva === 'opcionais' ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner' :
        'text-gray-600 hover:bg-gray-200 hover:text-gray-800'" class="flex-1 px-4 py-2 text-sm transition-all duration-200">
                        <i class="fas fa-cogs"></i> Opcionais do Veículo
                    </button>
                </div>

                <!-- Aba Info -->
                <div x-show="tabAtiva === 'info'" x-transition>
                    <div class="border border-green-500 rounded-xl p-6 mb-6 shadow-sm bg-white">
                        <div class="flex flex-wrap gap-2 mb-2">
                            @if (request('from') === 'novos')
                                <!-- Família -->
                                <div class="basis-[20%] flex-grow min-w-[150px]">
                                    <label class="block text-gray-700 font-medium mb-1">Família</label>
                                    <select name="familia"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                        <option value="">Selecione uma família</option>
                                        @foreach ($familias as $familia)
                                                                    <option value="{{ $familia->descricao }}" {{ old('familia') == $familia->descricao ?
                                            'selected' : '' }}>
                                                                        {{ $familia->descricao }}
                                                                    </option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <!-- Marca -->
                                <div class="basis-[10%] flex-grow min-w-[100px]">
                                    <label class="block text-gray-700 font-medium mb-1">Marca</label>
                                    <input required type="text" name="marca" value="{{ old('marca') }}"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none uppercase"
                                        oninput="this.value = this.value.toUpperCase()" required>
                                </div>

                            @endif

                            <!-- Descrição -->
                            <div class="basis-[40%] flex-grow min-w-[250px]">
                                <label class="block text-gray-700 font-medium mb-1">Modelo do Veículo</label>
                                <input type="text" name="desc_veiculo" value="{{ old('desc_veiculo') }}"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            </div>

                            <!-- Chassi -->
                            <div class="basis-[20%] flex-grow min-w-[180px]">
                                <label class="block text-gray-700 font-medium mb-1">Chassi</label>
                                <input type="text" name="chassi" value="{{ old('chassi') }}"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-noneuppercase"
                                    oninput="this.value = this.value.toUpperCase()" required>
                            </div>

                            @if (request('from') === 'novos')
                                <!-- Modelo de Fabricação -->
                                <div class="basis-[10%] flex-grow min-w-[100px]">
                                    <label class="block text-gray-700 font-medium mb-1">Fabricação</label>
                                    <input type="text" name="modelo_fab" x-model="modelo_fab"
                                        value="{{ old('modelo_fab') }}"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                </div>
                            @else
                                <div class="basis-[10%] flex-grow min-w-[100px]">
                                    <label class="block text-gray-700 font-medium mb-1">Placa</label>

                                    <input id="placa" type="text" name="placa" required value="{{ old('placa') }}"
                                        class="uppercase w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        x-init="Inputmask('AAA-9*99').mask($el)">

                                </div>

                            @endif
                        </div>

                        <div class="flex flex-wrap gap-2 mb-2">
                            <!-- Ano/Modelo -->
                            <div class="flex-grow basis-[12%] min-w-[100px]">
                                <label class="block text-gray-700 font-medium mb-1">Ano/Modelo</label>
                                <input required type="text" name="Ano_Mod" value="{{ old('Ano_Mod') }}"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    x-init="Inputmask('9999/9999').mask($el)">
                            </div>


                            <!-- Cor -->
                            <div class="flex-grow basis-[25%] min-w-[150px]">
                                <label class="block text-gray-700 font-medium mb-1">Cor</label>

                                @if (request('from') === 'usados')
                                    {{-- Campo digitável para veículos usados --}}
                                    <input type="text" name="cor" value="{{ old('cor') }}"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                @else
                                    {{-- Combo com cores disponíveis para veículos novos --}}
                                    <select name="cor"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                        <option value="">Selecione uma cor</option>
                                        @foreach ($cores as $cor)
                                            <option value="{{ $cor->cor_desc }}" {{ old('cor') === $cor->cor_desc ? 'selected' : ''
                                                                            }}>
                                                {{ $cor->cor_desc }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>


                            <!-- Motor -->
                            <div class="flex-grow basis-[5%] min-w-[80px]">
                                <label class="block text-gray-700 font-medium mb-1">Motor</label>
                                <input type="text" name="motor" value="{{ old('motor') }}"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            </div>

                            <!-- Portas -->
                            <div class="basis-[5%] min-w-[80px]">
                                <label class="block text-gray-700 font-medium mb-1">Portas</label>
                                <input type="number" name="portas" value="{{ old('portas') }}"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 text-center focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            </div>

                            <!-- Combustível -->
                            <div class="flex-grow basis-[25%] min-w-[200px]">
                                <label class="block text-gray-700 font-medium mb-1">Combustível</label>
                                <select name="combustivel"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                    @foreach (['Gasolina', 'Etanol', 'Diesel', 'Flex', 'Elétrico', 'GNV'] as $comb)
                                        <option value="{{ $comb }}" {{ old('combustivel') == $comb ? 'selected' : '' }}>{{ $comb
                                                        }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if (request('from') === 'novos')
                                <!-- Opcionais -->
                                <div class="basis-[10%] min-w-[80px]">
                                    <label class="block text-gray-700 font-medium mb-1">Opcional</label>
                                    <input type="text" name="cod_opcional" x-model="cod_opcional"
                                        value="{{ old('cod_opcional') }}"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                </div>
                            @endif
                        </div>

                        <!-- Valores -->
                        <div class="flex flex-row gap-2 mb-2">
                            @if (request('from') === 'novos')
                                <x-input-moeda name="vlr_nota" label="Valor Custo" :value="old('vlr_nota')" />
                                <x-input-moeda name="vlr_bonus" label="Valor Bônus" :value="old('vlr_bonus')" />
                                <x-input-moeda name="vlr_tabela" label="Valor Tabela" :value="old('vlr_tabela')" />
                            @else
                                <x-input-moeda name="vlr_nota" label="Valor Compra" :value="old('vlr_nota')" />
                                <x-input-moeda name="vlr_bonus" label="Valor Venda" :value="old('vlr_bonus')" />
                                <x-input-moeda name="vlr_tabela" label="Valor Tabela FIPE" :value="old('vlr_tabela')" />
                            @endif
                            <div class="mb-4">
                                <label for="local" class="block text-gray-700 font-medium mb-1">Local</label>
                                <select name="local" id="local" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">

                                    @if ($from === 'novos')
                                        <option value="matriz" {{ old('local') == 'matriz' ? 'selected' : '' }}>Matriz
                                        </option>
                                        <option value="filial" {{ old('local') == 'filial' ? 'selected' : '' }}>Filial
                                        </option>
                                        <option value="transito" {{ old('local') == 'transito' ? 'selected' : '' }}>
                                            Trânsito</option>
                                    @else
                                        <option value="matriz" {{ old('local') == 'matriz' ? 'selected' : '' }}>Matriz
                                        </option>
                                        <option value="filial" {{ old('local') == 'filial' ? 'selected' : '' }}>Filial
                                        </option>
                                        <option value="consignado" {{ old('local') == 'consignado' ? 'selected' : '' }}>
                                            Consignado
                                        </option>
                                    @endif

                                </select>
                            </div>
                        </div>
                        @if (request('origem') === 'propostas')
                            <input type="hidden" name="status" value="Avaliacao">
                            * Veiculos usados incluídos por proposta, permanecem com status de avaliação, até provação
                            gerencial.
                        @endif
                    </div>
                </div>

                <!-- Aba Fotos -->
                <div x-show="tabAtiva === 'fotos'" x-transition>
                    <div class="border border-green-500 rounded-xl p-6 mb-6 shadow-sm bg-white">
                        <label class="block text-gray-700 font-medium mb-1">Imagens do Veículo (até 10 - .jpg)</label>
                        <div x-data="previewImagesAvancado()" class="space-y-4">
                            <!-- Input de arquivos -->
                            <input type="file" accept=".jpg" multiple @change="adicionarImagens($event)"
                                x-ref="inputFile" class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0 file:text-sm file:font-semibold
                                   file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">

                            <!-- Contador -->
                            <div class="text-sm text-gray-600">
                                <span x-text="arquivos.length"></span>/10 imagens selecionadas
                            </div>

                            <!-- Mensagem de erro -->
                            <template x-if="erroLimite">
                                <div class="text-red-600 text-sm font-medium">
                                    Limite de 10 imagens atingido. Remova alguma para adicionar novas.
                                </div>
                            </template>

                            <template x-if="erroFormato">
                                <div class="text-red-600 text-sm font-medium">
                                    Apenas arquivos <strong>.jpg</strong> são permitidos.
                                </div>
                            </template>

                            <!-- Preview com drag-and-drop -->
                            <ul class="flex flex-wrap gap-4" x-ref="previewList" @dragover.prevent
                                @drop="reordenarArquivos($event)">
                                <template x-for="(img, index) in previews" :key="img . nome">
                                    <li class="relative w-20 h-20 cursor-move" draggable="true"
                                        @dragstart="inicioArraste(index)" @dragend="fimArraste()">
                                        <img :src="img . src"
                                            class="w-full h-full object-cover rounded border border-gray-300 shadow-sm">
                                        <button type="button" @click="removerImagem(index)"
                                            class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center shadow hover:bg-red-700"
                                            title="Remover imagem">×</button>
                                    </li>
                                </template>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Aba Opcionais -->
                <div x-show="tabAtiva === 'opcionais'" x-transition>
                    <div class="border border-green-500 rounded-xl p-6 mb-6 shadow-sm bg-white">
                        @if (request('from') === 'novos')
                            <div class="flex flex-col md:flex-row gap-6 w-full">
                                <div class="flex flex-col gap-4 w-full md:w-[280px]">
                                    <div class="relative">
                                        <label class="block text-sm font-medium text-gray-700">Código Fabricação</label>
                                        <input type="text" name="modelo_fab" :value="modelo_fab" disabled
                                            title="Este campo é preenchido automaticamente"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-600 cursor-not-allowed pr-10">
                                        <span class="absolute right-2 top-8 text-gray-400">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>


                                    <div class="relative">
                                        <label class="block text-sm font-medium text-gray-700">Código do Opcional</label>
                                        <input type="text" name="cod_opcional" :value="cod_opcional" disabled
                                            title="Este campo é preenchido automaticamente"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-600 cursor-not-allowed pr-10">
                                        <span class="absolute right-2 top-8 text-gray-400">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>

                                </div>
                                <div class="w-full md:flex-1 mb-4">
                                    <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                                    <textarea name="descricao" id="descricao" rows="6" maxlength="5000"
                                        class="mt-1 block w-full h-full border-gray-300 rounded-md shadow-sm">{{ old('descricao') }}</textarea>
                                </div>
                            </div>
                        @elseif(request('from') === 'usados')
                            <div class="flex flex-col gap-4">
                                <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                                <textarea name="descricao" id="descricao" rows="6" maxlength="5000"
                                    class="mt-1 block w-full h-full border-gray-300 rounded-md shadow-sm">{{ old('descricao') }}</textarea>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Botões -->
                <div class="flex justify-between mt-8">
                    @if (request('from') === 'novos')
                        <a href="{{ route('veiculos.novos.index') }}"
                            class="flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-2 rounded-md shadow-md transition">
                            <i class="fas fa-arrow-left"></i> Ir para Veiculos Novos
                        </a>
                    @else
                        @if (request('origem') === 'propostas')
                            @php
                                $params = request()->all();
                                $queryString = http_build_query($params);
                            @endphp
                            <a href="{{ route('propostas.create') . '?' . $queryString }}"
                                class="inline-flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md shadow-md">
                                <i class="fas fa-arrow-left"></i> Voltar para Propostas
                            </a>
                        @else
                            <a href="{{route('veiculos.usados.index') }}"
                                class="flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-2 rounded-md shadow-md transition">
                                <i class="fas fa-arrow-left"></i> Ir para Veiculos Usados
                            </a>
                        @endif
                    @endif


                    @if (request('from') === 'novos')
                        <a href="{{ route('familia.index', ['from' => 'create', 'origem' => request('from')]) }}"
                            class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2 rounded-md shadow-md transition">
                            <i class="fas fa-users"></i>
                            Cadastro Famílias
                        </a>
                    @endif


                    <button type="submit"
                        class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-md shadow-md transition">
                        <i class="fas fa-save"></i> Salvar Veículo
                    </button>
                </div>
            </form>
            <br>
            <br>
            <br>
            <br>
        </div>

        <!-- Rodapé padrão -->
        <x-rodape>
            <div class="font-medium">Cadastro de veículos novos e usados</div>
            <div class="flex flex-wrap gap-1 items-center">
                <span class="text-sm text-gray-700">Use as abas acima para preencher todas as informações do
                    veículo</span>
            </div>
        </x-rodape>

        <!-- Modal de Ajuda -->
        <div id="modalAjuda" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div
                class="bg-white rounded-lg shadow-xl max-w-3xl w-full p-6 relative flex gap-6 animate-shake border-t-4 border-blue-400">
                <!-- Ícone  -->
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white p-2 rounded-full shadow">
                    <i class="fas fa-info-circle text-blue-500 text-4xl"></i>
                </div>

                <!-- Conteúdo -->
                <div class="flex-1 relative">
                    <!-- Botão fechar -->
                    <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                        class="absolute top-0 right-0 text-red-500 hover:text-red-700 text-2xl">
                        &times;
                    </button>

                    <h2 class="text-2xl font-bold text-blue-600 mb-4">Instruções para Cadastro de Veículos</h2>

                    <p class="mb-3 text-sm text-gray-700 leading-relaxed">
                        Esta tela permite o cadastro de <strong>veículos novos e usados</strong>, separados por abas.
                        Preencha todas as informações necessárias de acordo com o tipo de veículo selecionado.
                    </p>

                    <ul class="list-disc list-inside text-sm text-gray-800 space-y-2">
                        <li><strong>Aba Informações:</strong> Preencha dados como modelo, chassi, cor, combustível,
                            ano/modelo, valores e localização.</li>
                        <li><strong>Aba Imagens:</strong> Faça o upload de até 10 imagens no formato .jpg. É possível
                            reordená-las por drag and drop.</li>
                        <li><strong>Aba Opcionais:</strong> Inclua os opcionais do veículo. Para veículos novos, alguns
                            campos são preenchidos automaticamente.</li>
                        <li><strong>Validações:</strong> Campos obrigatórios e formatos como placa e ano são validados
                            automaticamente via máscara.</li>
                        <li><strong>Origem:</strong> Em caso de origem de proposta, o status é definido como
                            "Avaliação".
                        </li>
                        <li><strong>Salvamento:</strong> Clique em <strong>Salvar Veículo</strong> após revisar todos os
                            dados.</li>
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
            function previewImagesAvancado() {
                return {
                    arquivos: [],
                    previews: [],
                    erroLimite: false,
                    erroFormato: false,
                    dragIndex: null,

                    adicionarImagens(event) {
                        const novosArquivos = Array.from(event.target.files);
                        let adicionados = 0;

                        novosArquivos.forEach(file => {
                            // Verifica se é .jpg
                            if (!file.name.toLowerCase().endsWith('.jpg')) {
                                this.erroFormato = true;
                                setTimeout(() => this.erroFormato = false, 4000);
                                return;
                            }

                            // Evita duplicação por nome
                            if (!this.arquivos.find(f => f.name === file.name) && this.arquivos.length < 10) {
                                this.arquivos.push(file);
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    this.previews.push({
                                        src: e.target.result,
                                        nome: file.name
                                    });
                                };
                                reader.readAsDataURL(file);
                                adicionados++;
                            }
                        });

                        event.target.value = null;

                        this.erroLimite = this.arquivos.length >= 10;
                        if (this.erroLimite) {
                            setTimeout(() => this.erroLimite = false, 4000);
                        }

                        this.atualizarInputReal();
                    },

                    removerImagem(index) {
                        this.arquivos.splice(index, 1);
                        this.previews.splice(index, 1);
                        this.atualizarInputReal();
                    },

                    atualizarInputReal() {
                        const dataTransfer = new DataTransfer();
                        this.arquivos.forEach(file => dataTransfer.items.add(file));
                        this.$refs.inputFile.files = dataTransfer.files;
                    },

                    // Drag and drop
                    inicioArraste(index) {
                        this.dragIndex = index;
                    },

                    fimArraste() {
                        this.dragIndex = null;
                    },

                    reordenarArquivos(event) {
                        const dropIndex = Array.from(this.$refs.previewList.children).indexOf(event.target.closest('li'));
                        if (this.dragIndex === null || dropIndex === -1 || this.dragIndex === dropIndex) return;

                        const moverArquivo = this.arquivos.splice(this.dragIndex, 1)[0];
                        const moverPreview = this.previews.splice(this.dragIndex, 1)[0];

                        this.arquivos.splice(dropIndex, 0, moverArquivo);
                        this.previews.splice(dropIndex, 0, moverPreview);

                        this.atualizarInputReal();
                    }
                };
            }
        </script>


</x-app-layout>
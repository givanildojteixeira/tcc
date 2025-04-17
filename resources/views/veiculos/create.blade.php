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
        <!-- Título -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-blue-600">Cadastrar novo Veículo</h2>
            <x-bt-ajuda />
        </div>

        <!-- Formulário -->
        <form method="POST" action="{{ route('veiculos.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            @if (request('from'))
            <input type="hidden" name="from" value="{{ request('from') }}">
            @endif

            {{-- Para validação de erros --}}
            {{-- <x-validation-errors id="modalErrosCadastro" /> --}}

            <!-- Abas -->
            <div class="flex bg-gray-100 rounded-md overflow-hidden shadow-sm mb-6 font-bold">
                <button type="button" @click="setTab('info')" :class="tabAtiva === 'info' ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner' :
                        'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                    class="flex-1 px-4 py-2 text-sm transition-all duration-200">
                    <i class="fas fa-car"></i> Informações do Veículo
                </button>
                <button type="button" @click="setTab('fotos')" :class="tabAtiva === 'fotos' ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner' :
                        'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                    class="flex-1 px-4 py-2 text-sm transition-all duration-200">
                    <i class="fas fa-image"></i> Imagens do Veículo
                </button>
                <button type="button" @click="setTab('opcionais')" :class="tabAtiva === 'opcionais' ? 'bg-blue-100 text-blue-700 font-semibold shadow-inner' :
                        'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                    class="flex-1 px-4 py-2 text-sm transition-all duration-200">
                    <i class="fas fa-cogs"></i> Opcionais do Veículo
                </button>
            </div>

            <!-- Aba Info -->
            <div x-show="tabAtiva === 'info'" x-transition>
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
                                <option value="{{ $familia->descricao }}" {{ old('familia')==$familia->descricao ?
                                    'selected' : '' }}>
                                    {{ $familia->descricao }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- Descrição -->
                        <div class="basis-[40%] flex-grow min-w-[250px]">
                            <label class="block text-gray-700 font-medium mb-1">Descrição do Veículo</label>
                            <input type="text" name="desc_veiculo" value="{{ old('desc_veiculo') }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        </div>

                        <!-- Chassi -->
                        <div class="basis-[20%] flex-grow min-w-[180px]">
                            <label class="block text-gray-700 font-medium mb-1">Chassi</label>
                            <input type="text" name="chassi" value="{{ old('chassi') }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        </div>

                        @if (request('from') === 'novos')
                        <!-- Modelo de Fabricação -->
                        <div class="basis-[10%] flex-grow min-w-[100px]">
                            <label class="block text-gray-700 font-medium mb-1">Fabricação</label>
                            <input type="text" name="modelo_fab" x-model="modelo_fab" value="{{ old('modelo_fab') }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        </div>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-4 mb-4">
                        <!-- Ano/Modelo -->
                        <div class="flex-grow basis-[12%] min-w-[100px]">
                            <label class="block text-gray-700 font-medium mb-1">Ano/Modelo</label>
                            <input type="text" name="Ano_Mod" value="{{ old('Ano_Mod') }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        </div>

                        <!-- Cor -->
                        <div class="flex-grow basis-[25%] min-w-[150px]">
                            <label class="block text-gray-700 font-medium mb-1">Cor</label>
                            <input type="text" name="cor" value="{{ old('cor') }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        </div>

                        <!-- Cor -->
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
                                <option value="">Selecione</option>
                                @foreach (['Gasolina', 'Etanol', 'Diesel', 'Flex'] as $comb)
                                <option value="{{ $comb }}" {{ old('combustivel')==$comb ? 'selected' : '' }}>{{ $comb
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
                    <div class="flex flex-row gap-4 mb-4">
                        <x-input-moeda name="vlr_nota" label="Valor Custo" :value="old('vlr_nota')" />
                        <x-input-moeda name="vlr_bonus" label="Valor Bônus" :value="old('vlr_bonus')" />
                        <x-input-moeda name="vlr_tabela" label="Valor Tabela" :value="old('vlr_tabela')" />
                        <div class="mb-4">
                            <label for="local" class="block text-sm font-medium text-gray-700">Local</label>
                            <select name="local" id="local" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                <option value="">Selecione o local</option>

                                @if ($from === 'novos')
                                <option value="matriz" {{ old('local')=='matriz' ? 'selected' : '' }}>Matriz
                                </option>
                                <option value="filial" {{ old('local')=='filial' ? 'selected' : '' }}>Filial
                                </option>
                                <option value="transito" {{ old('local')=='transito' ? 'selected' : '' }}>
                                    Trânsito</option>
                                @else
                                <option value="matriz" {{ old('local')=='matriz' ? 'selected' : '' }}>Matriz
                                </option>
                                <option value="filial" {{ old('local')=='filial' ? 'selected' : '' }}>Filial
                                </option>
                                <option value="consignado" {{ old('local')=='consignado' ? 'selected' : '' }}>
                                    Consignado</option>
                                @endif
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Aba Fotos -->
            <div x-show="tabAtiva === 'fotos'" x-transition>
                <div class="border border-green-500 rounded-xl p-6 mb-6 shadow-sm bg-white">
                    <label class="block text-gray-700 font-medium mb-1">Imagens do Veículo (até 10 - .jpg)</label>
                    <div x-data="previewImagesAvancado()" class="space-y-4">
                        <!-- Input de arquivos -->
                        <input type="file" accept=".jpg" multiple @change="adicionarImagens($event)" x-ref="inputFile"
                            class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
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
                            <template x-for="(img, index) in previews" :key="img.nome">
                                <li class="relative w-20 h-20 cursor-move" draggable="true"
                                    @dragstart="inicioArraste(index)" @dragend="fimArraste()">
                                    <img :src="img.src"
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
                <a href="{{ request('from') === 'usados' ? route('veiculos.usados.index') : route('veiculos.novos.index') }}"
                    class="flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-2 rounded-md shadow-md transition">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>

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
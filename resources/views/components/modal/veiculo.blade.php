<div x-data="galeriaVeiculo" x-init="$watch('veiculo.chassi', chassi => carregarImagens(chassi))"> <!-- ✅ MODAL VEICULO NOVOS E USADOS -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        style="display: none;">
        <div class="bg-white p-2 rounded-lg shadow-lg w-full max-w-5xl relative">

            <!-- Botão Fechar -->
            <button @click="open = false"
                class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>

            <!-- Cabeçalho -->
            <h2 class="text-2xl font-bold mb-4 text-blue-600 text-center">
                Detalhes do Veículo {{ $tipo ?? '' }}: <span x-text="veiculo.desc_veiculo"
                    class="text-green-600"></span>
            </h2>

            <!-- Área Principal -->
            <div class="flex flex-col md:flex-row gap-6 items-start">
                <!-- Coluna Esquerda -->
                <div class="flex flex-col w-full md:w-1/2 gap-1">

                    <!-- Bloco da Imagem -->
                    <div class="relative w-full h-58 overflow-hidden border border-gray-300 rounded-md">
                        <!-- Seta Esquerda -->
                        <button @click="anterior"
                            class="absolute left-0 top-1/2 -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 px-3 py-2 rounded-full shadow">
                            &#8592;
                        </button>

                        <!-- Imagem Dinâmica -->
                        <div class="flex items-center justify-center">
                            {{-- Deixa a figura centraliza e com tamanhos fixos --}}
                            <img :src="imagemAtual()" alt="Imagem veículo" class="w-[400px] h-[255px] object-cover rounded-md">
                        </div>


                        <!-- Seta Direita -->
                        <button @click="proxima"
                            class="absolute right-0 top-1/2 -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 px-3 py-2 rounded-full shadow">
                            &#8594;
                        </button>
                    </div>

                    <!-- Bloco Opcionais -->
                    <div class="border border-gray-300 rounded-md p-4 h-48 overflow-y-auto mt-1 text-[14px]">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center gap-2"><i
                                    class="fas fa-layer-group text-blue-500"></i><span><strong>Família:</strong> <span
                                        x-text="veiculo.familia"></span></span></div>
                            <div class="flex items-center gap-2"><i
                                    class="fas fa-industry text-blue-500"></i><span><strong>Modelo:</strong> <span
                                        x-text="veiculo.modelo_fab"></span></span></div>
                            <div class="flex items-center gap-2"><i
                                    class="fas fa-gas-pump text-blue-500"></i><span><strong>Combustível:</strong> <span
                                        x-text="veiculo.combustivel"></span></span></div>
                            <div class="flex items-center gap-2"><i
                                    class="fas fa-calendar-alt text-blue-500"></i><span><strong>Ano/Modelo:</strong>
                                    <span x-text="veiculo.Ano_Mod"></span></span></div>
                            <div class="flex items-center gap-2"><i
                                    class="fas fa-barcode text-blue-500"></i><span><strong>Chassi:</strong> <span
                                        x-text="veiculo.chassi"></span></span></div>
                            <div class="flex items-center gap-2"><i
                                    class="fas fa-palette text-blue-500"></i><span><strong>Cor:</strong> <span
                                        x-text="veiculo.cor"></span></span></div>
                            <div class="flex items-center gap-2"><i
                                    class="fas fa-door-closed text-blue-500"></i><span><strong>Portas:</strong> <span
                                        x-text="veiculo.portas"></span></span></div>
                            <div class="flex items-center gap-2"><i
                                    class="fas fa-coins text-blue-500"></i><span><strong>Preço:</strong> R$ <span
                                        x-text="veiculo.vlr_tabela"></span></span></div>
                        </div>
                    </div>
                </div>

                <!-- Coluna Direita -->
                <div x-show="open"
                    class="w-full md:w-1/2 border border-gray-300 rounded-md p-4 text-sm text-gray-700 self-stretch">
                    <h3 class="font-semibold text-gray-700">Opcionais do Modelo:
                        <span x-text="veiculo.modelo_fab"></span>
                        <span class="font-medium text-gray-500">| Código:</span>
                        <span x-text="veiculo.cod_opcional"></span>
                    </h3>

                    <div class="flex-1 max-h-[400px] overflow-auto pr-2">
                        <ul class="list-disc list-inside space-y-1">
                            <template x-for="item in veiculo.descricao_opcional.split('/').filter(i => i.trim())"
                                :key="item">
                                <li x-text="item.trim()"></li>
                            </template>
                        </ul>
                    </div>

                    <div class="text-gray-400 italic mt-2" x-show="!veiculo.descricao_opcional">Nenhum opcional
                        encontrado.</div>
                </div>
            </div>

            <!-- Rodapé -->
            <div class="mt-2 pt-1 flex flex-wrap gap-2 justify-center">
                <x-bt-padrao label="Voltar" color="gray" icon="arrow-left" title="Fechar ou voltar"
                    @click=" open = false" />
                <x-bt-padrao label="Editar" color="blue" icon="pen-to-square" title="Editar veículo"
                    @click=" window.location.href = `/veiculos/${veiculo.id}/edit?from=${veiculo.origem}`" />

                <template x-if="veiculo.origem === 'novos'">
                    <div class="flex flex-wrap gap-1">
                        <a x-show="veiculo.site"
                            :href="veiculo.site.startsWith('http') ? veiculo.site : 'https://' + veiculo.site"
                            target="_blank" title="Site de Apoio."
                            class="min-w-[100px] flex items-center gap-2 px-6 py-2 rounded-md text-white bg-green-500 hover:bg-green-600 shadow-md">
                            <i class="fas fa-hands-helping"></i>Apoio
                        </a>
                        <x-bt-padrao x-show="!veiculo.site" disabled color="gray" icon="hands-helping" label="Apoio" title="Site de apoio não cadastrado!" />

                        <a
                            :href="`/mev/${veiculo.familia}.pdf`"
                            target="_blank"
                            class="min-w-[100px] flex items-center gap-2 px-6 py-2 rounded-md shadow-md transition font-medium text-white bg-yellow-500 hover:bg-yellow-600"
                            title="Manual de Especificação de Venda."
                        >
                            <i class="fas fa-book-open"></i> M.E.V.
                        </a>

                        <x-bt-padrao
                            href="/mev/precos.pdf"
                            target="_blank"
                            color="pink"
                            icon="tags"
                            label="Tabela Preços"
                            title="Tabela de Preço Geral Atualizada"
                        />

                    </div>
                </template>

                <template x-if="veiculo.origem === 'usados'">
                    <x-bt-padrao color="teal" icon="chart-line" label="Consulta Fipe" href="https://www.fipe.org.br"
                        target="_blank" title="Consulta de Preço Padrão." />
                </template>

                <x-bt-padrao type="submit" color="teal" icon="folder-open" label="Documentos"
                    title="Pasta de Apoio Documentos" />
                <x-bt-padrao type="submit" color="green" icon="file-signature" label="Proposta"
                    title="Abertura de Proposta" />
            </div>
        </div>
    </div>
</div>

<script>
    function galeriaVeiculo() {
        return {
            imagens: [],
            indiceAtual: 0,

            carregarImagens(chassi) {

                this.imagens = [];
                this.indiceAtual = 0;

                for (let i = 1; i <= 10; i++) {
                    const num = i.toString().padStart(2, '0');
                    const url = `/images/cars/${chassi}_${num}.jpg`;

                    fetch(url, {
                        method: 'HEAD'
                    }).then(res => {
                        if (res.ok) this.imagens.push(url);
                    });
                }

                // fallback após 1s caso nenhuma imagem válida
                setTimeout(() => {
                    if (this.veiculo.origem === 'novos') {
                        this.imagens = [`/images/familia/${this.veiculo.familia}.jpg`];
                    } else {
                        this.imagens = ["{{ asset('images/seminovos.jpg') }}"];
                    }
                    this.indiceAtual = 0;
                }, 1);
            },

            imagemAtual() {
                return this.imagens[this.indiceAtual] || '{{ asset("images/seminovos.jpg") }}';
            },

            proxima() {
                if (this.indiceAtual < this.imagens.length - 1) this.indiceAtual++;
            },

            anterior() {
                if (this.indiceAtual > 0) this.indiceAtual--;
            }
        };
    }
</script>

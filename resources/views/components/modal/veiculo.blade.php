<div><!-- ✅ MODAL VEICULO NOVOS E USADOS -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        style="display: none;">
        <div class="bg-white p-2 rounded-lg shadow-lg w-full max-w-5xl relative">
            <!-- Botão Fechar -->
            <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">
                &times;
            </button>

            <!-- Cabeçalho -->
            <h2 class="text-2xl font-bold mb-4 text-blue-600 text-center">
                Detalhes do Veículo {{ $tipo ?? '' }}:
                <span x-text="veiculo.desc_veiculo" class="text-green-600"></span>
            </h2>


            <!-- Área Principal -->
            <div class="flex flex-col md:flex-row gap-6 items-start">
                <!-- Coluna Esquerda: Bloco 1 (Foto) + Bloco 3 (Opcionais) -->
                <div class="flex flex-col w-full md:w-1/2 gap-1">

                    <!-- Bloco 1: Imagem com borda -->
                    <div class="relative w-full h-58 overflow-hidden border border-gray-300 rounded-md">
                        <!-- Seta Esquerda -->
                        <button
                            class="absolute left-0 top-1/2 -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 px-3 py-2 rounded-full shadow">
                            &#8592;
                        </button>

                        <!-- Imagem do Veículo -->
                        <div class="w-full h-full">
                            <div
                                x-html="`
                                <img
                                    src='{{ asset('images/familia') }}/${veiculo.familia}.jpg'
                                    alt='${veiculo.familia}'
                                    class=\'w-full h-full object-cover rounded-md\'
                                    {{-- caso nao tenha foto entao mostra alternativa --}}
                                    onerror=\'this.onerror=null;this.src=&quot;{{ asset('images/seminovos.jpg') }}&quot;\'
                                >
                            `">
                            </div>
                        </div>


                        <!-- Seta Direita -->
                        <button
                            class="absolute right-0 top-1/2 -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 px-3 py-2 rounded-full shadow">
                            &#8594;
                        </button>
                    </div>

                    <!-- Bloco 3: Opcionais -->
                    <div class="border border-gray-300 rounded-md p-4 h-48 overflow-y-auto mt-1 text-[14px]">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-layer-group text-blue-500"></i>
                                <span><strong>Família:</strong> <span x-text="veiculo.familia"></span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-industry text-blue-500"></i>
                                <span><strong>Modelo:</strong> <span x-text="veiculo.modelo_fab"></span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-gas-pump text-blue-500"></i>
                                <span><strong>Combustível:</strong> <span x-text="veiculo.combustivel"></span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-blue-500"></i>
                                <span><strong>Ano/Modelo:</strong> <span x-text="veiculo.Ano_Mod"></span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-barcode text-blue-500"></i>
                                <span><strong>Chassi:</strong> <span x-text="veiculo.chassi"></span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-palette text-blue-500"></i>
                                <span><strong>Cor:</strong> <span x-text="veiculo.cor"></span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-door-closed text-blue-500"></i>
                                <span><strong>Número de Portas:</strong> <span x-text="veiculo.portas"></span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-coins text-blue-500"></i>
                                <span><strong>Preço: R$ </strong> <span x-text="veiculo.vlr_tabela"></span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bloco dos Opcionais no Modal -->
                <div x-show="open"
                    class="w-full md:w-1/2 border border-gray-300 rounded-md p-4 text-sm text-gray-700 self-stretch">

                    <h3 class="font-semibold text-gray-700">Opcionais do Modelo:
                        <span x-text="veiculo.modelo_fab"></span>
                        <span class="font-medium text-gray-500">| Código:</span>
                        <span x-text="veiculo.cod_opcional"></span>
                    </h3>


                    <!-- Lista com scroll que ocupa o restante da div -->
                    <div class="flex-1 max-h-[400px] overflow-auto pr-2">
                        <ul class="list-disc list-inside space-y-1">
                            <template x-for="item in veiculo.descricao_opcional.split('/').filter(i => i.trim())"
                                :key="item">
                                <li x-text="item.trim()"></li>
                            </template>
                        </ul>
                    </div>

                    <!-- Fallback caso não tenha nada -->
                    <div class="text-gray-400 italic mt-2" x-show="!veiculo.descricao_opcional">
                        Nenhum opcional encontrado.
                    </div>

                </div>





            </div>

            <!-- Botoes e Rodapé -->
            <div class="mt-2 border-t pt-1 flex flex-wrap gap-2 justify-center">

                <button @click="open = false"
                    class="bg-gray-400 hover:bg-gray-500 text-white font-medium px-4 py-2 rounded shadow flex items-center gap-2"
                    data-atalho="voltar">
                    <i class="fas fa-arrow-left"></i> Voltar
                </button>

                {{-- Botao para edição do veiculo com a origem para auxiliar o retorno --}}
                <button @click="window.location.href = `/veiculos/${veiculo.id}/edit?from=${veiculo.origem}`"
                    title="Abre tela de edição do arquivo"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded shadow flex items-center gap-2"
                    data-atalho="voltar">
                    <i class="fas fa-pen-to-square"></i> Editar
                </button>


                <!-- Para veículos novos: "Apoio GM", MEV e Tabela Preços -->
                <template x-if="veiculo.origem === 'novos'">
                    <div class="flex flex-wrap gap-2">
                        <!-- Botão com site -->
                        <a x-show="veiculo.site"
                            :href="veiculo.site.startsWith('http') ? veiculo.site : 'https://' + veiculo.site"
                            target="_blank" title="Site de apoio da montadora."
                            class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded shadow flex items-center gap-2 transition">
                            <i class="fas fa-hands-helping"></i> Apoio GM
                        </a>

                        <!-- Botão desabilitado se não tiver site -->
                        <button x-show="!veiculo.site" disabled
                            class="bg-gray-300 text-gray-500 cursor-not-allowed font-medium px-4 py-2 rounded shadow flex items-center gap-2">
                            <i class="fas fa-hands-helping"></i> Apoio GM
                        </button>

                        {{-- @php
                        $caminhoPdf = 'mev/' . str_replace(' ', '_', $veiculo->familia) . '.pdf';
                        $pdfExiste = arquivo_existe($caminhoPdf);
                    @endphp

                    @if ($pdfExiste)
                        <!-- Botão M.E.V. -->
                        <button type="button" @click="window.open('{{ asset($caminhoPdf) }}', '_blank')"
                            title="Manual de Especificação de Vendas."
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded shadow flex items-center gap-2">
                            <i class="fas fa-book-open"></i> M.E.V.
                        </button>
                    @else
                        <!-- Botão desabilitado -->
                        <button type="button"
                            onclick="mostrarToast('Arquivo M.E.V. não encontrado para esta família.')"
                            class="bg-gray-300 text-gray-500 font-medium px-4 py-2 rounded shadow flex items-center gap-2 cursor-not-allowed"
                            title="Arquivo M.E.V. não disponível.">
                            <i class="fas fa-book-open"></i> M.E.V.
                        </button>
                    @endif --}}


                        <!-- Botão M.E.V. -->
                        <button type="button" @click="window.open(`/mev/${veiculo.familia}.pdf`, '_blank')"
                            title="Manual de Especificação de Vendas."
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded shadow flex items-center gap-2">
                            <i class="fas fa-book-open"></i> M.E.V.
                        </button>

                        <!-- Botão Tabela de Preços -->
                        <button @click="window.open(`/mev/precos.pdf`, '_blank')"
                            title="Última tabela de preços divulgada"
                            class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-4 py-2 rounded shadow flex items-center gap-2">
                            <i class="fas fa-tags"></i> Tabela Preços
                        </button>
                    </div>
                </template>


                <!-- Para veículos usados: "Consulta Fipe" -->
                <template x-if="veiculo.origem === 'usados'">
                    <a href="https://www.fipe.org.br" target="_blank" title="Consultar valor do veículo na Tabela Fipe"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded shadow flex items-center gap-2 transition">
                        <i class="fas fa-chart-line"></i> Consulta Fipe
                    </a>
                </template>

                <button
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium px-4 py-2 rounded shadow flex items-center gap-2"
                    title="Demais documentos, campanhas ou instrução para auxilio a venda"><i
                        class="fas fa-folder-open"></i> Documentos
                </button>

                <button
                    class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded shadow flex items-center gap-2"
                    title="Elaboração de Proposta de Venda"><i class="fas fa-file-signature"></i> Proposta
                </button>

            </div>


        </div>
    </div>
    {{-- mostrarToast() --}}
    <div x-data="{ toast: null }" x-init="window.mostrarToast = (msg) => {
        toast = msg;
        setTimeout(() => toast = null, 3000);
    }" class="fixed top-4 right-4 z-50">
        <div x-show="toast" x-transition class="bg-red-500 text-white px-4 py-2 rounded shadow text-sm">
            <span x-text="toast"></span>
        </div>
    </div>
</div>

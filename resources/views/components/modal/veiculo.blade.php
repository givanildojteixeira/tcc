<!-- ✅ Modal de Detalhes de veiculos novos e semi-novos-->
<div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    style="display: none;">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-5xl relative">
        <!-- Botão Fechar -->
        <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">
            &times;
        </button>

        <!-- Cabeçalho -->
        <h2 class="text-2xl font-bold mb-4 text-blue-600 text-center">Detalhes do Veículo {{ $tipo ?? '' }} <span
                x-text="veiculo.desc_veiculo"></span> </h2>


        <!-- Conteúdo do Modal em colunas -->
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Coluna da Imagem -->
            <div class="flex-shrink-0 w-full md:w-1/2">
                <!-- Aqui usamos Blade dentro do Alpine com x-html -->
                <div
                    x-html="`<img src='{{ asset('images/familia') }}/${veiculo.familia}.jpg' alt='${veiculo.familia}' class='w-full h-auto object-cover rounded-md border border-gray-200 max-h-96'>`">
                </div>
            </div>

            <!-- Coluna dos Detalhes com borda -->
            <div class="w-full md:w-1/2">
                <div class="border border-gray-300 rounded-md p-4 text-sm text-gray-700 space-y-2">
                    <div><strong>Codigo:</strong> <span x-text="veiculo.id"></span></div>
                    <div><strong>Família:</strong> <span x-text="veiculo.familia"></span></div>
                    <div><strong>Veículo:</strong> <span x-text="veiculo.desc_veiculo"></span></div>
                    <div><strong>Modelo:</strong> <span x-text="veiculo.modelo_fab"></span></div>
                    <div><strong>Combustível:</strong> <span x-text="veiculo.combustivel"></span></div>
                    <div><strong>Ano/Modelo:</strong> <span x-text="veiculo.Ano_Mod"></span></div>
                    <div><strong>Chassi:</strong> <span x-text="veiculo.chassi"></span></div>
                    <div><strong>Cor:</strong> <span x-text="veiculo.cor"></span></div>
                    <div><strong>Portas:</strong> <span x-text="veiculo.portas"></span></div>
                    <div><strong>Opcionais:</strong> <span x-text="veiculo.cod_opcional"></span></div>
                    <div><strong>Tabela:</strong> <span x-text="veiculo.vlr_tabela"></span></div>
                    <div><strong>Bônus:</strong> <span x-text="veiculo.vlr_bonus"></span></div>
                    <div><strong>Custo:</strong> <span x-text="veiculo.vlr_nota"></span></div>
                    <div><strong>Faturado há:</strong> <span x-text="veiculo.faturado"></span> dias</div>
                </div>
            </div>
        </div>

        <!-- Rodapé com botões -->
        <div class="mt-6 border-t pt-4 flex flex-wrap gap-2 justify-center">
            <button @click="open = false"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded">
                Voltar
            </button>
            <button @click="window.location.href = `/veiculos/${veiculo.id}/edit`"
                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded">
                Editar
            </button>

            <button class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded">
                Site Internet
            </button>
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded">
                Prospecto
            </button>
            <button class="bg-purple-500 hover:bg-purple-600 text-white font-medium px-4 py-2 rounded">
                Proposta
            </button>
        </div>
    </div>
</div>

<!-- Botão de Ajuda -->
<button onclick="document.getElementById('modalAjuda').classList.remove('hidden')"
    class="text-blue-600 hover:text-blue-800 text-xl" title="Ajuda">
    <i class="fas fa-question-circle"></i>
</button>

{{--

Estrutura para funcionar :
...
<!-- Botão de Ajuda -->
<x-bt-ajuda />
...
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

            <h2 class="text-2xl font-bold text-blue-600 mb-4">Instruções da Tela de Veículos Novos</h2>

            <p class="mb-3 text-sm text-gray-700 leading-relaxed">
                Esta tela tem como objetivo <strong>exibir e filtrar veículos novos</strong> disponíveis no estoque,
                tanto da Matriz quanto das filias ou até mesmo em trânsito.
                Utilize os recursos abaixo para uma busca eficaz:
            </p>

            <ul class="list-disc list-inside text-sm text-gray-800 space-y-2">
                <li><strong>Carrossel de Imagens:</strong> Clique sobre a imagem de um veículo para filtrar modelos
                    da mesma família.</li>
                <li><strong>Combos de Filtro:</strong> Utilize as caixas Combustível, Ano/Modelo, Transmissão ou Cor
                    para refinar sua busca. </li>
                <li><strong>Busca por Modelo:</strong> Se uma familia estiver selecionada, estará visivel os modelos
                    desta familia de veículos, caso contrário aparecerá todos os modelos
                    disponiveis nos estoques ou em trânsito </li>
                <li><strong>Busca por Chassi:</strong> Permite localizar veículos digitando parte do número do
                    chassi.</li>
                <li><strong>Legenda de Cores:</strong> Indica a localização dos veículos: <span
                        class="text-black font-bold">Matriz</span>, <span
                        class="text-yellow-500 font-bold">Filial</span> ou <span
                        class="text-green-500 font-bold">Trânsito</span>
                    , clique sobre eles para refinar ainda mais sua busca.</li>
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
...

--}}



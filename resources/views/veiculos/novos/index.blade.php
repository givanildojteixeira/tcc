<!-- VEICULOS NOVOS -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-1">
            <!-- Carrossel de Veículos -->
            <div class="relative bg-white shadow-lg rounded-lg overflow-hidden w-2/3"
                title="Clique sobre o veículo para filtrar todos os modelos de sua Família.">
                <div id="carrossel" class="splide w-full bg-white shadow-lg rounded-lg p-3">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($imagens as $index => $imagem)
                                @php
                                    $familia = ucfirst(pathinfo(basename($imagem), PATHINFO_FILENAME));
                                    $familiaSelecionada = request()->query('familia');
                                    $selecionado = $familiaSelecionada == $familia ? 'border-4 border-blue-500' : '';
                                    $textoSelecionado =
                                        $familiaSelecionada == $familia ? 'text-blue-600 font-bold' : '';
                                @endphp

                                <li class="splide__slide text-center cursor-pointer" data-index="{{ $index }}"
                                    onclick="atualizarFiltro('familia', '{{ $familia }}')">
                                    <img src="{{ asset('images/familia/' . basename($imagem)) }}"
                                        alt="{{ $familia }}"
                                        class="rounded-lg max-w-[100px] max-h-[100px] object-cover {{ $selecionado }}">
                                    <div class="text-sm font-semibold mt-2 text-center {{ $textoSelecionado }}">
                                        {{ $familia }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Filtros de modelo e chassi -->
            <div class="flex justify-center bg-white shadow-lg rounded-lg overflow-hidden p-3 w-1/3">
                <div class="grid grid-cols-1 gap-2 w-full">
                    <!-- ComboBox Modelo -->
                    <div class="flex items-center gap-2 w-full">
                        <span class="text-xs font-semibold text-gray-600 whitespace-nowrap">Modelo:</span>
                        <select id="modeloVeiculo"
                            class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('modelo', this.value)">
                            <option value="" disabled {{ empty(session('modelo_selecionado')) ? 'selected' : '' }}>Selecione</option>
                            @foreach ($veiculosUnicos as $veiculo)
                                <option value="{{ $veiculo->desc_veiculo }}"
                                    {{ session('modelo_selecionado') == $veiculo->desc_veiculo ? 'selected' : '' }}>
                                    {{ $veiculo->desc_veiculo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo de Pesquisa Chassi com Botão -->
                    <div class="flex items-center gap-2 w-full">
                        <span class="text-xs font-semibold text-gray-600 whitespace-nowrap">Chassi:</span>
                        <input type="text" id="chassiPesquisa"
                            class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            placeholder="Digite parte do chassi" value="{{ session('chassi_selecionado', '') }}">
                        <button onclick="atualizarFiltro('chassi', document.getElementById('chassiPesquisa').value)"
                            class="px-3 py-1 text-white bg-blue-500 rounded-md hover:bg-blue-600 text-xs">
                            🔍
                        </button>
                    </div>
                </div>
            </div>


            <!-- Card para Pesquisas Combinadas -->
            <div class="flex justify-center bg-white shadow-lg rounded-lg overflow-hidden p-3 w-1/2">
                <div class="grid grid-cols-2 gap-2 w-full">
                    <!-- Combustível -->
                    <div class="flex items-center gap-2 w-full">
                        <span class="text-xs font-semibold text-gray-600 whitespace-nowrap">Combustível:</span>
                        <select id="combustivel"
                            class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('combustivel', this.value)">
                            <option value="" disabled {{ empty(session('combustivel_selecionado')) ? 'selected' : '' }}>Selecione</option>
                            <option value="Gasolina" {{ session('combustivel_selecionado') == 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                            <option value="Alcool" {{ session('combustivel_selecionado') == 'Alcool' ? 'selected' : '' }}>Álcool</option>
                            <option value="Flex" {{ session('combustivel_selecionado') == 'Flex' ? 'selected' : '' }}>Flex</option>
                            <option value="Diesel" {{ session('combustivel_selecionado') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="Eletrico" {{ session('combustivel_selecionado') == 'Eletrico' ? 'selected' : '' }}>Elétrico</option>
                        </select>
                    </div>

                    <!-- Ano/Modelo -->
                    <div class="flex items-center gap-2 w-full">
                        <span class="text-xs font-semibold text-gray-600 whitespace-nowrap">Ano/Modelo:</span>
                        <select id="anoModelo"
                            class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('ano', this.value)">
                            <option value="" disabled {{ empty(session('ano_selecionado')) ? 'selected' : '' }}>Selecione</option>
                            <option value="2024/2024" {{ session('ano_selecionado') == '2024/2024' ? 'selected' : '' }}>2024/2024</option>
                            <option value="2024/2025" {{ session('ano_selecionado') == '2024/2025' ? 'selected' : '' }}>2024/2025</option>
                            <option value="2025/2025" {{ session('ano_selecionado') == '2025/2025' ? 'selected' : '' }}>2025/2025</option>
                            <option value="2025/2026" {{ session('ano_selecionado') == '2025/2026' ? 'selected' : '' }}>2025/2026</option>
                        </select>
                    </div>

                    <!-- Transmissão -->
                    <div class="flex items-center gap-2 w-full">
                        <span class="text-xs font-semibold text-gray-600 whitespace-nowrap">Transmissão:</span>
                        <select name="transmissao"
                            class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('transmissao', this.value)">
                            <option value="" disabled selected>Selecione</option>
                            <option value="Mecânica" {{ session('transmissao_selecionado') == 'Mecânica' ? 'selected' : '' }}>Mecânica</option>
                            <option value="Automático" {{ session('transmissao_selecionado') == 'Automático' ? 'selected' : '' }}>Automático</option>
                            <option value="CVT" {{ session('transmissao_selecionado') == 'CVT' ? 'selected' : '' }}>CVT</option>
                        </select>
                    </div>

                    <!-- Cor -->
                    <div class="flex items-center gap-2 w-full">
                        <span class="text-xs font-semibold text-gray-600 whitespace-nowrap">Cor:</span>
                        <select name="corVeiculos"
                            class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('cor', this.value)">
                            <option value="" {{ empty(session('cor_selecionado')) ? 'selected' : '' }}>Todos</option>
                            @foreach ($cores as $cor)
                                <option value="{{ $cor->cor }}" {{ session('cor_selecionado') == $cor->cor ? 'selected' : '' }}>
                                    {{ $cor->cor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <!-- Card para Botões de ajuda e limpa filtros -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-2 w-[4%] flex flex-col items-center justify-center gap-2">
                <!-- Botão de Ajuda -->
                <button onclick="document.getElementById('modalAjuda').classList.remove('hidden')"
                    class="text-blue-600 hover:text-blue-800 text-xl" title="Ajuda">
                    <i class="fas fa-question-circle"></i>
                </button>

                <!-- Botão de Limpar Filtros -->
                <button onclick="limparFiltros()" title="Limpar Filtros"
                    class="text-red-600 hover:text-red-800 text-xl">
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>
        </div>
    </x-slot>

    <div> <!-- Tabelas dos dados -->
        <div class="w-full max-w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="text-gray-900" id="tabela-wrapper">
                        <table class="table-auto w-full">
                            <thead class="bg-gray-100 text-left sticky top-0 z-10">
                                <tr>
                                    <th class="sortable p-2" data-column="veiculo">Veículo <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="modelo">Modelo <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="combustivel">Comb <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="ano_mod">Ano_Mod <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="chassi">Chassi <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="cor">Cor <i class="fas fa-sort"></i></th>
                                    <th class="sortable p-2" data-column="pts">Pts <i class="fas fa-sort"></i></th>
                                    <th class="sortable p-2" data-column="opcional">Opc. <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="tabela">Tabela <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="bonus">Bonus <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="custo">Custo <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="faturado">Faturado <i
                                            class="fas fa-sort"></i>
                                    </th>
                                    <th class="hidden">Local</th> <!-- Coluna oculta -->
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach ($veiculos as $veiculo)
                                    @php
                                        $rowColor = '';
                                        if ($veiculo->local == 'Matriz') {
                                            $rowColor = 'text-black';
                                        } elseif ($veiculo->local == 'Filial') {
                                            $rowColor = 'text-yellow-500';
                                        } elseif ($veiculo->local == 'Transito') {
                                            $rowColor = 'text-green-500';
                                        }
                                    @endphp
                                    <tr class="hover:bg-gray-100 {{ $rowColor }}">
                                        <td class="p-2">{{ $veiculo->desc_veiculo }}</td>
                                        <td class="p-2">{{ $veiculo->modelo_fab }}</td>
                                        <td class="p-2">{{ $veiculo->combustivel }}</td>
                                        <td class="p-2">{{ $veiculo->Ano_Mod }}</td>
                                        <td class="p-2">{{ $veiculo->chassi }}</td>
                                        <td class="p-2">{{ $veiculo->cor }}</td>
                                        <td class="p-2">{{ $veiculo->portas }}</td>
                                        <td class="p-2">{{ $veiculo->cod_opcional }}</td>
                                        <td class="p-2">{{ number_format($veiculo->vlr_tabela, 0, ',', '.') }}</td>
                                        <td class="p-2">{{ number_format($veiculo->vlr_bonus, 0, ',', '.') }}</td>
                                        <td class="p-2">{{ number_format($veiculo->vlr_nota, 0, ',', '.') }}</td>
                                        <td class="p-2">
                                            {{ \Carbon\Carbon::parse($veiculo->dta_faturamento)->diffInDays(now()) }}
                                            dias
                                        </td>
                                        <td class="hidden">{{ $veiculo->local }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra fixa abaixo da tabela -->
    <div class="fixed bottom-0 left-0 w-full bg-white shadow-lg p-2 border-t border-gray-300">
        <div class="flex justify-between items-center">
            <!-- Número de veículos selecionados -->
            <div class="text-lg font-semibold" id="selectedVehiclesCount">
                Veículos Listados: {{ count($veiculos) }}
            </div>
            <!-- Exibir os links de navegação da página -->
            <div class="pagination">
                {{ $veiculos->links() }}
            </div>
            <!-- Legenda de cores -->
            <div class="text-sm"> Legenda Alocação =>
                <span class="filter text-black font-semibold" data-filter="Matriz"
                    style="cursor: pointer;">Matriz</span> |
                <span class="filter text-yellow-500 font-semibold" data-filter="Filial"
                    style="cursor: pointer;">Filial</span> |
                <span class="filter text-green-500 font-semibold" data-filter="Transito"
                    style="cursor: pointer;">Trânsito</span>
            </div>
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

    <!-- Scripts -->
    <script>
        function atualizarFiltro(chave, valor) {
            let params = new URLSearchParams(window.location.search);

            if (valor) {
                params.set(chave, valor); // Adiciona ou substitui o filtro
            } else {
                params.delete(chave); // Remove o filtro se for vazio
            }

            // Redireciona para a rota correta com os filtros aplicados
            window.location.href = "{{ route('veiculos.novos.index') }}?" + params.toString();
        }

        // Carrossel
        document.addEventListener('DOMContentLoaded', function() {
            // Verifica qual slide tem a borda azul (selecionado)
            const slides = document.querySelectorAll('#carrossel .splide__slide');
            let selectedIndex = 0;

            slides.forEach((slide, index) => {
                if (slide.querySelector('img')?.classList.contains('border-blue-500')) {
                    selectedIndex = index;
                }
            });

            const splide = new Splide('#carrossel', {
                perPage: 5,
                start: selectedIndex,
                arrows: true,
                gap: '1rem',
                breakpoints: {
                    1280: {
                        perPage: 4
                    },
                    1024: {
                        perPage: 3
                    },
                    768: {
                        perPage: 2
                    },
                    480: {
                        perPage: 1
                    },
                },
            });

            splide.mount();

        });

        function limparFiltros() {
            window.location.href = "{{ route('veiculos.novos.index') }}";
        }


        // Ordenação da tabela ao clicar no cabeçalho
        const headers = document.querySelectorAll('.sortable');
        let sortDirection = 'asc'; // Direção inicial (ascendente)

        headers.forEach(header => {
            const icon = header.querySelector('i');
            if (icon) {
                // Inicializa o ícone de ordenação
                icon.classList.add('fa-sort');
            }

            header.addEventListener('click', function() {
                const column = header.getAttribute('data-column');
                sortTable(column, sortDirection);

                // Alterna a direção de ordenação
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';

                // Remove os ícones de todas as colunas
                headers.forEach(h => {
                    const icon = h.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-sort-up', 'fa-sort-down');
                        icon.classList.add('fa-sort'); // Reseta o ícone para o padrão
                    }
                });

                // Atualiza o ícone da coluna ordenada
                const icon = header.querySelector('i');
                if (sortDirection === 'asc') {
                    icon.classList.remove('fa-sort');
                    icon.classList.add('fa-sort-up'); // Ícone de ordenação ascendente
                } else {
                    icon.classList.remove('fa-sort');
                    icon.classList.add('fa-sort-down'); // Ícone de ordenação descendente
                }

                // Realce a coluna que foi ordenada
                headers.forEach(h => h.classList.remove('sorted'));
                header.classList.add('sorted'); // Adiciona a classe para a coluna ordenada
            });
        });

        function sortTable(column, direction) {
            const rows = Array.from(document.querySelectorAll('tbody tr'));
            const index = Array.from(headers).findIndex(header => header.getAttribute('data-column') ===
                column);
            const isNumeric = column === 'pts' || column === 'tabela' || column === 'bonus' || column ===
                'custo' || column === 'faturado'; // Defina quais colunas são numéricas

            rows.sort((rowA, rowB) => {
                const cellA = rowA.cells[index].textContent.trim();
                const cellB = rowB.cells[index].textContent.trim();

                let a = isNumeric ? parseFloat(cellA.replace(/[^0-9.-]+/g, "")) : cellA.toLowerCase();
                let b = isNumeric ? parseFloat(cellB.replace(/[^0-9.-]+/g, "")) : cellB.toLowerCase();

                if (a < b) {
                    return direction === 'asc' ? -1 : 1;
                }
                if (a > b) {
                    return direction === 'asc' ? 1 : -1;
                }
                return 0;
            });

            // Reorganiza as linhas no corpo da tabela
            const tbody = document.querySelector('tbody');
            rows.forEach(row => tbody.appendChild(row));
        }

        // Variável para filtro da legenda (Local)
        let activeFilter = null;

        // Função para aplicar o filtro e atualizar o contador
        function applyFilter() {
            const rows = Array.from(document.querySelectorAll('tbody tr'));
            let visibleCount = 0; // Contador de veículos visíveis

            // Se nenhum filtro estiver ativo, exiba todas as linhas
            if (!activeFilter) {
                rows.forEach(row => {
                    row.style.display = '';
                });
                visibleCount = rows.length;
            } else {
                // Exiba apenas as linhas que correspondem ao filtro ativo
                rows.forEach(row => {
                    const local = row.querySelector('td:nth-child(13)').textContent.trim();
                    if (local === activeFilter) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Atualizar o contador na interface
            const contador = document.getElementById('selectedVehiclesCount');
            contador.textContent = activeFilter ?
                `Filtro Aplicado [${activeFilter}] - Veículos listados: ${visibleCount}` :
                `Veículos Listados: ${visibleCount}`;
        }

        // Evento de clique nas legendas
        document.querySelectorAll('.filter').forEach(filter => {
            filter.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');

                // Se já estiver ativo, desativa o filtro
                activeFilter = (activeFilter === filterValue) ? null : filterValue;

                // Aplica o filtro e atualiza o contador
                applyFilter();
            });
        });
    </script>
</x-app-layout>

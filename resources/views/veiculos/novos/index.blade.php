<x-app-layout> <!-- VEICULOS NOVOS FILTRO PRINCIPAL-->
    <x-slot name="header">
        <div class="flex gap-1">
            <!-- Carrossel de Veículos -->
            <div class="relative bg-white shadow-lg rounded-lg overflow-hidden w-2/3"
                title="Clique sobre o veículo para filtrar todos os modelos de sua Família.">
                <div id="carrossel" class="splide w-full bg-white shadow-lg rounded-lg p-3">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($familiasValidas as $index => $familia)
                            @php
                            $nome = $familia['nome'];
                            $imagem = $familia['imagem'];
                            $familiaSelecionada = request()->query('familia');
                            $selecionado = $familiaSelecionada == $nome ? 'border-4 border-blue-500' : '';
                            $textoSelecionado = $familiaSelecionada == $nome ? 'text-blue-600 font-bold' : '';
                            @endphp

                            <li class="splide__slide text-center cursor-pointer" data-index="{{ $index }}"
                                onclick="atualizarFiltro('familia', '{{ $nome }}')">
                                <img src="{{ asset($imagem) }}" alt="{{ $nome }}"
                                    class="rounded-lg max-w-[100px] max-h-[100px] object-cover {{ $selecionado }}">
                                <div class="text-sm font-semibold mt-2 text-center {{ $textoSelecionado }}">
                                    {{ $nome }}
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
                            <option value="" disabled
                                {{ empty(session('modelo_selecionado')) ? 'selected' : '' }}>Selecione</option>
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
                            class="w-8 h-8 flex items-center justify-center bg-green-500 text-white rounded-full hover:bg-green-600 transition duration-200"
                            title="Buscar Chassi">
                            <i class="fas fa-search text-sm"></i>
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
                            <option value=""
                                {{ empty(session('combustivel_selecionado')) ? 'selected' : '' }}>Todas</option>
                            @foreach ($combustiveis as $combustivel)
                            <option value="{{ $combustivel->combustivel }}"
                                {{ session('combustivel_selecionado') == $combustivel->combustivel ? 'selected' : '' }}>
                                {{ $combustivel->combustivel }}
                            </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Ano/Modelo -->
                    <div class="flex items-center gap-2 w-full">
                        <span class="text-xs font-semibold text-gray-600 whitespace-nowrap">Ano/Modelo:</span>
                        <select id="anoModelo"
                            class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('ano', this.value)">
                            <option value="" {{ empty(session('ano_selecionado')) ? 'selected' : '' }}>
                                Todas</option>
                            @foreach ($anosUnico as $ano)
                            <option value="{{ $ano->Ano_Mod }}"
                                {{ session('ano_selecionado') == $ano->Ano_Mod ? 'selected' : '' }}>
                                {{ $ano->Ano_Mod }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Transmissão -->
                    <div class="flex items-center gap-2 w-full">
                        <span class="text-xs font-semibold text-gray-600 whitespace-nowrap">Transmissão:</span>
                        <select name="transmissao"
                            class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('transmissao', this.value)">
                            <option value="" disabled selected>Selecione</option>
                            @foreach ($transmissoes as $transmissao)
                            <option value="{{ $transmissao->transmissao }}"
                                {{ session('transmissao_selecionado') == $transmissao->transmissao ? 'selected' : '' }}>
                                {{ $transmissao->transmissao }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cor -->
                    <div class="flex items-center gap-2 w-full">
                        <span class="text-xs font-semibold text-gray-600 whitespace-nowrap">Cor:</span>
                        <select name="corVeiculos"
                            class="flex-1 px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('cor', this.value)">
                            <option value="" {{ empty(session('cor_selecionado')) ? 'selected' : '' }}>Todas
                            </option>
                            @foreach ($cores as $cor)
                            <option value="{{ $cor->cor }}"
                                {{ session('cor_selecionado') == $cor->cor ? 'selected' : '' }}>
                                {{ $cor->cor }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Card para Botões de ajuda e limpa filtros -->
            <div
                class="bg-white shadow-lg rounded-lg overflow-hidden w-[3%] flex flex-col items-center justify-center ">
                <!-- Botão de Ajuda -->
                <button onclick="document.getElementById('modalAjuda').classList.remove('hidden')"
                    class="text-blue-600 hover:text-blue-800 text-xl" title="Ajuda">
                    <i class="fas fa-question-circle"></i>
                </button>

                <!-- Botão Relatorios -->
                <button onclick="gerarRelatorio()" title="Imprimir" class="text-green-600 hover:text-green-800 text-xl">
                    <i class="fas fa-print"></i>
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
                        <div x-data="{ open: false, veiculo: {} }"> <!-- Alpine no escopo global -->
                            <table class="table-auto w-full ml-2 mr-2">
                                <thead class="bg-gray-100 text-left sticky top-0 z-10">
                                    <tr>
                                        <th class="sortable p-2" data-column="veiculo">Veículo <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i></th>
                                        <th class="sortable p-2" data-column="modelo">Modelo <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2" data-column="combustivel">Comb <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2" data-column="combustivel">Transm. <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2" data-column="ano_mod">Ano_Mod <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2" data-column="chassi">Chassi <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2" data-column="cor">Cor <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2" data-column="pts">Pts <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2" data-column="opcional">Opc. <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2 text-right" data-column="tabela">Tabela <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2 text-right" data-column="bonus">Bonus <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2 text-right" data-column="custo">Custo <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-2" data-column="faturado">Faturado <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
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
                                    $descricaoOpcional =
                                    \App\Models\Opcionais::where('modelo_fab', $veiculo->modelo_fab)
                                    ->where('cod_opcional', $veiculo->cod_opcional)
                                    ->value('descricao') ?? 'Nenhum opcional encontrado.';

                                    $siteFamilia =
                                    \App\Models\Familia::where('descricao', $veiculo->familia)->value(
                                    'site',) ?? '';
                                    @endphp
                                    <tr class="hover:bg-gray-100 cursor-pointer {{ $rowColor }}"
                                        @click="
                                                open = true;
                                                veiculo = {
                                                    id: '{{ $veiculo->id }}',
                                                    desc_veiculo: '{{ $veiculo->desc_veiculo }}',
                                                    descricao_opcional: @js($descricaoOpcional),
                                                    familia: '{{ $veiculo->familia }}',
                                                    modelo_fab: '{{ $veiculo->modelo_fab }}',
                                                    combustivel: '{{ $veiculo->combustivel }}',
                                                    transmissao: '{{ $veiculo->transmissao }}',
                                                    Ano_Mod: '{{ $veiculo->Ano_Mod }}',
                                                    chassi: '{{ $veiculo->chassi }}',
                                                    cor: '{{ $veiculo->cor }}',
                                                    portas: '{{ $veiculo->portas }}',
                                                    site: @js($siteFamilia),
                                                    cod_opcional: '{{ $veiculo->cod_opcional }}',
                                                    vlr_tabela: '{{ number_format($veiculo->vlr_tabela, 0, ',', '.') }}',
                                                    vlr_bonus: '{{ number_format($veiculo->vlr_bonus, 0, ',', '.') }}',
                                                    vlr_nota: '{{ number_format($veiculo->vlr_nota, 0, ',', '.') }}',
                                                    faturado: '{{ \Carbon\Carbon::parse($veiculo->dta_faturamento)->diffInDays(now()) }}',
                                                    {{-- Essa linha leva a origem para o modal, assim ele saberá como voltar --}}
                                                    origem: '{{ request()->routeIs("veiculos.novos.*") ? 'novos' : 'usados' }}'
                                                }
                                            ">
                                        <td class="p-1 px-1 py-1">{{ $veiculo->desc_veiculo }}</td>
                                        <td class="p-1 px-1 py-1">{{ $veiculo->modelo_fab }}</td>
                                        <td class="p-1 px-1 py-1">{{ $veiculo->combustivel }}</td>
                                        <td class="p-1 px-1 py-1">{{ $veiculo->transmissao }}</td>
                                        <td class="p-1 px-1 py-1">{{ $veiculo->Ano_Mod }}</td>
                                        <td class="p-1 px-1 py-1">{{ $veiculo->chassi }}</td>
                                        <td class="p-1 px-1 py-1">{{ $veiculo->cor }}</td>
                                        <td class="p-1 px-1 py-1 text-center">{{ $veiculo->portas }}</td>
                                        <td class="p-1 px-1 py-1 text-center">{{ $veiculo->cod_opcional }}</td>
                                        <td class="p-1 px-1 py-1 text-right">
                                            {{ number_format($veiculo->vlr_tabela, 0, ',', '.') }}
                                        </td>
                                        <td class="p-1 px-1 py-1 text-right">
                                            {{ number_format($veiculo->vlr_bonus, 0, ',', '.') }}
                                        </td>
                                        <td class="p-1 px-1 py-1 text-right">
                                            {{ number_format($veiculo->vlr_nota, 0, ',', '.') }}
                                        </td>
                                        <td class="p-1 px-1 py-1 text-center">
                                            {{ \Carbon\Carbon::parse($veiculo->dta_faturamento)->diffInDays(now()) }}
                                            dias
                                        </td>
                                        <td class="hidden">{{ $veiculo->local }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- ✅ Modal de Detalhes -->
                            @include('components.modal.veiculo', ['tipo' => 'Novo'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra fixa abaixo da tabela -->
    <x-rodape>
        <!-- Número de veículos listados -->
        <div class="font-medium" id="selectedVehiclesCount">
            Veículos Listados: {{ count($veiculos) }}
        </div>

        <!-- Paginação -->
        <div class="pagination">
            {{ $veiculos->links() }}
        </div>

        <!-- Legenda de cores -->
        <div class="flex flex-wrap gap-1 items-center">
            <span class="font-medium">Legenda Alocação =&gt;</span>
            <span class="filter font-semibold text-black cursor-pointer" data-filter="Matriz">Matriz</span> |
            <span class="filter font-semibold text-yellow-500 cursor-pointer" data-filter="Filial">Filial</span> |
            <span class="filter font-semibold text-green-500 cursor-pointer" data-filter="Transito">Trânsito</span>
        </div>
    </x-rodape>


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
            window.location.href = "{{ route('veiculos.novos.limparFiltros') }}";
        }

        function gerarRelatorio() {
            const url = new URL(window.location.href);

            // Adiciona ou substitui o parâmetro 'relatorio'
            url.searchParams.set('relatorio', '1');

            // Redireciona para a nova URL
            window.location.href = url.toString();
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

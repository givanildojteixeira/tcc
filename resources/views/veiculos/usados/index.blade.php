<!-- VEICULOS USADOS -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-1">
            <!-- Card para Pesquisas Combinadas -->
            <div class="relative bg-white shadow-lg rounded-lg overflow-hidden w-2/3 p-2">
                <div class="grid grid-cols-3 gap-2 items-center content-center h-full">

                    <!-- ComboBox Marca -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold text-gray-600">Marca:</span>
                        <select id="marcaVeiculo"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('marca', this.value)">
                            <option value="" {{ empty(session('marca_selecionado')) ? 'selected' : '' }}>Todos
                            </option>
                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->marca }}"
                                    {{ session('marca_selecionado') == $marca->marca ? 'selected' : '' }}>
                                    {{ $marca->marca }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ComboBox Modelo -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold text-gray-600">Modelo:</span>
                        <select id="modeloVeiculo"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('modelo', this.value)">
                            <option value="" {{ empty(session('modelo_selecionado')) ? 'selected' : '' }}>
                                Todos</option>
                            @foreach ($veiculosUnicos as $veiculo)
                                <option value="{{ $veiculo->desc_veiculo }}"
                                    {{ session('modelo_selecionado') == $veiculo->desc_veiculo ? 'selected' : '' }}>
                                    {{ $veiculo->desc_veiculo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Combustível -->
                    <div class="flex items-center gap-1">
                        <span class="text-xs font-semibold text-gray-600">Combustível:</span>
                        <select id="combustivel"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('combustivel', this.value)">
                            <option value="" {{ empty(session('combustivel_selecionado')) ? 'selected' : '' }}>
                                Todos</option>
                            <option value="Gasolina"
                                {{ session('combustivel_selecionado') == 'Gasolina' ? 'selected' : '' }}>Gasolina
                            </option>
                            <option value="Alcool"
                                {{ session('combustivel_selecionado') == 'Alcool' ? 'selected' : '' }}>Álcool</option>
                            <option value="Flex"
                                {{ session('combustivel_selecionado') == 'Flex' ? 'selected' : '' }}>Flex</option>
                            <option value="Diesel"
                                {{ session('combustivel_selecionado') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="Eletrico"
                                {{ session('combustivel_selecionado') == 'Eletrico' ? 'selected' : '' }}>Elétrico
                            </option>
                        </select>
                    </div>

                    <!-- Cores Veículos -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold text-gray-600">Cor:</span>
                        <select id="corVeiculo"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('cor', this.value)">
                            <option value="" {{ empty(session('cor_selecionado')) ? 'selected' : '' }}>
                                Todos</option>
                            @foreach ($cores as $cor)
                                <option value="{{ $cor->cor }}"
                                    {{ session('cor_selecionado') == $cor->cor ? 'selected' : '' }}>
                                    {{ $cor->cor }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Ano_Mod Veículos -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold text-gray-600">Ano/Modelo:</span>
                        <select id="anoVeiculo"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('ano', this.value)">
                            <option value="" {{ empty(session('ano_selecionado')) ? 'selected' : '' }}>
                                Todos</option>
                            @foreach ($anos as $ano)
                                <option value="{{ $ano['Ano_Mod'] }}"
                                    {{ session('ano_selecionado') == $ano['Ano_Mod'] ? 'selected' : '' }}>
                                    {{ $ano['Ano_Mod'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Portas -->
                    <div class="flex items-center gap-1">
                        <span class="text-xs font-semibold text-gray-600">Portas:</span>
                        <select id="portas"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('portas', this.value)">
                            <option value="" {{ empty(session('portas_selecionado')) ? 'selected' : '' }}>Todos
                            </option>
                            <option value="2" {{ session('portas_selecionado') == '2' ? 'selected' : '' }}>2
                            </option>
                            <option value="4" {{ session('portas_selecionado') == '4' ? 'selected' : '' }}>4
                            </option>
                            <option value="5" {{ session('portas_selecionado') == '5' ? 'selected' : '' }}>5
                            </option>
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Bloco de pesquisa especifica --}}
            <div class="flex justify-center bg-white shadow-lg rounded-lg overflow-hidden w-1/3 p-2">
                <div class="flex flex-col w-full">
                    <!-- Campo de Pesquisa Chassi com Botão -->
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-xs font-semibold text-gray-600">Chassi:</span>
                        <input type="text" id="chassiPesquisa"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            placeholder="Digite parte do chassi" value="{{ session('chassi_selecionado', '') }}">
                        <button onclick="atualizarFiltro('chassi', document.getElementById('chassiPesquisa').value)"
                            class="px-1 py-1 text-white rounded-md hover:bg-blue-600">
                            🔍
                        </button>
                    </div>

                    <!-- Filtro de Preço -->
                    <div class="flex items-center justify-between gap-2 w-full text-xs text-gray-600">
                        <div class="text-xs font-semibold text-center leading-tight"> Faixa de Valor </div>
                        <div class="flex flex-col items-center w-full">
                            <div id="slider-preco" class="w-full"></div>
                            <div class="flex justify-between w-full mt-1 px-1 text-[11px]">
                                <span id="minValorLabel">R$
                                    {{ number_format(session('valor_min', 0), 2, ',', '.') }}</span>
                                <span id="maxValorLabel">R$
                                    {{ number_format(session('valor_max', 1000000), 2, ',', '.') }}</span>
                            </div>
                        </div>
                        <button onclick="aplicarFiltroPreco()"
                            class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-full text-sm"
                            title="Aplicar Filtro">
                            <i class="fas fa-check"></i>
                        </button>
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
                <button onclick="limparFiltros()" title="Imprimir"
                    class="text-green-600 hover:text-green-800 text-xl">
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

    <div> <!-- Tabela de dados -->
        <div class="w-full max-w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="text-gray-900" id="tabela-wrapper">
                        <table class="table-auto w-full">
                            <thead class="bg-gray-100 text-left sticky top-0 z-10">
                                <tr>
                                    <th class="sortable p-2" data-column="marca">Marca <i
                                            class="fas fa-sort text-gray-400 text-xs ml-1"></i></th>
                                    <th class="sortable p-2" data-column="veiculo">Modelo<i
                                            class="fas fa-sort text-gray-400 text-xs ml-1"></i> </th>
                                    <th class="sortable p-2" data-column="combustivel">Comb <i
                                            class="fas fa-sort text-gray-400 text-xs ml-1"></i> </th>
                                    <th class="sortable p-2" data-column="ano/mod">Ano_Mod <i
                                            class="fas fa-sort text-gray-400 text-xs ml-1"></i> </th>
                                    <th class="sortable p-2" data-column="chassi">Chassi <i
                                            class="fas fa-sort text-gray-400 text-xs ml-1"></i> </th>
                                    <th class="sortable p-2" data-column="cor">Cor <i
                                            class="fas fa-sort text-gray-400 text-xs ml-1"></i></th>
                                    <th class="sortable p-2" data-column="pts">Pts<i
                                            class="fas fa-sort text-gray-400 text-xs ml-1"></i></th>
                                    <th class="sortable p-2 text-right" data-column="custo">Custo <i
                                            class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                    </th>
                                    <th class="sortable p-2 text-right" data-column="tabela">Tabela <i
                                            class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="faturado">Estoque<i
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
                                        } elseif ($veiculo->local == 'Consignado') {
                                            $rowColor = 'text-green-500';
                                        }
                                    @endphp
                                    <tr class="hover:bg-gray-100 {{ $rowColor }}">
                                        <td class="p-2">{{ $veiculo->marca }}</td>
                                        <td class="p-2">{{ $veiculo->desc_veiculo }}</td>
                                        <td class="p-2">{{ $veiculo->combustivel }}</td>
                                        <td class="p-2 text-center">{{ $veiculo->Ano_Mod }}</td>
                                        <td class="p-2">{{ $veiculo->chassi }}</td>
                                        <td class="p-2">{{ $veiculo->cor }}</td>
                                        <td class="p-2  text-center">{{ $veiculo->portas }}</td>
                                        <td class="p-2 text-right"> {{ number_format($veiculo->vlr_nota, 0, ',', '.') }}</td>
                                        <td class="p-2 text-right"> {{ number_format($veiculo->vlr_tabela, 0, ',', '.') }}</td>
                                        <td class="p-2 text-center">
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
    <x-rodape>
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
            <span class="filter text-black font-semibold" data-filter="Matriz" style="cursor: pointer;">Matriz</span>
            |
            <span class="filter text-yellow-500 font-semibold" data-filter="Filial"
                style="cursor: pointer;">Filial</span> |
            <span class="filter text-green-500 font-semibold" data-filter="Consignado"
                style="cursor: pointer;">Consignado</span>
        </div>
    </x-rodape>

    <!-- Scripts -->
    <script>
        // Atualiza Filtros e redireciona para a rota correta com os filtros aplicados
        function atualizarFiltro(chave, valor) {
            let params = new URLSearchParams(window.location.search);

            if (valor) {
                params.set(chave, valor); // Adiciona ou substitui o filtro
            } else {
                params.delete(chave); // Remove o filtro se for vazio
            }

            window.location.href = "{{ route('veiculos.usados.index') }}?" + params.toString();
        }

        // Aplica filtro por valor
        document.addEventListener("DOMContentLoaded", function() {
            const slider = document.getElementById('slider-preco');

            noUiSlider.create(slider, {
                start: [{{ session('valor_min', 0) }}, {{ session('valor_max', 1000000) }}],
                connect: true,
                step: 1000,
                range: {
                    'min': 0000,
                    'max': 1000000
                },
                format: {
                    to: value => parseInt(value),
                    from: value => parseInt(value)
                }
            });

            const minLabel = document.getElementById('minValorLabel');
            const maxLabel = document.getElementById('maxValorLabel');

            slider.noUiSlider.on('update', function(values) {
                minLabel.innerText = `R$ ${parseInt(values[0]).toLocaleString('pt-BR')}`;
                maxLabel.innerText = `R$ ${parseInt(values[1]).toLocaleString('pt-BR')}`;
            });

            window.aplicarFiltroPreco = function() {
                const valores = slider.noUiSlider.get();
                const params = new URLSearchParams(window.location.search);

                params.set('valor_min', valores[0]);
                params.set('valor_max', valores[1]);

                window.location.href = "{{ route('veiculos.usados.index') }}?" + params.toString();
            };
        });


        // Redireciona para a página sem parâmetros de filtro
        function limparFiltros() {
            window.location.href = window.location.pathname;
        }

        // Ordenação da tabela ao clicar no cabeçalho
        document.addEventListener("DOMContentLoaded",
            function() {
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
                            const local = row.querySelector('td:nth-child(11)').textContent.trim();
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



            });
    </script>
</x-app-layout>

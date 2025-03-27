<!-- VEICULOS USADOS -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-2">
            <!-- Card para Pesquisas Combinadas -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-2 w-4/6">
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
            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-2 w-full w-2/6">
                <div class="flex flex-col w-full">
                    <!-- Campo de Pesquisa Chassi com Botão -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold text-gray-600">Chassi:</span>
                        <input type="text" id="chassiPesquisa"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            placeholder="Digite parte do chassi"
                            value="{{ session('chassi_selecionado', '') }}">
                        <button onclick="atualizarFiltro('chassi', document.getElementById('chassiPesquisa').value)"
                            class="px-3 py-1 text-white rounded-md hover:bg-blue-600">
                            🔍
                        </button>
                    </div>

                    <!-- Filtro de Preço -->
                    <span class="text-xs font-semibold text-gray-600 border-t border-gray-500">
                        Faixa de Preço:
                        <span id="minValorLabel">Min R$
                            {{ number_format(session('valor_min', 30000), 2, ',', '.') }}</span>
                        &nbsp;⇄&nbsp;
                        <span id="maxValorLabel">Max R$
                            {{ number_format(session('valor_max', 200000), 2, ',', '.') }}</span>
                    </span>

                    <!-- Sliders ocupando toda a largura -->
                    <div class="flex items-center gap-2 w-full">
                        <input type="range" id="minValor" name="valor_min" min="30000" max="200000"
                            step="1000" value="{{ session('valor_min', 30000) }}" oninput="atualizarValores()"
                            class="w-full">

                        <input type="range" id="maxValor" name="valor_max" min="30000" max="200000"
                            step="1000" value="{{ session('valor_max', 200000) }}" oninput="atualizarValores()"
                            class="w-full">
                        <button onclick="aplicarFiltroPreco()"
                            class="px-3 py-1 text-white rounded-md hover:bg-blue-600">
                            🔍
                        </button>
                    </div>
                </div>
            </div>
            {{-- Bloco Limpa filtro --}}
            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-2 w-full w-1/6">
                <div class="grid grid-cols-3 gap-2 items-center content-center h-full">
                    <div class="flex justify-center items-center col-span-3">
                        <button onclick="limparFiltros()"
                            class="px-4 py-2 text-black border border-red-500 bg-white rounded-md text-xs hover:bg-red-100 hover:border-red-600 flex items-center gap-2">
                            <span>❌</span> Limpar Filtros
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div> <!-- Container flexível -->
        <div class="w-full max-w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="text-gray-900" id="tabela-wrapper">
                        <table class="table-auto w-full">
                            <thead class="bg-gray-100 text-left sticky top-0 z-10">
                                <tr>
                                    <th class="sortable p-2" data-column="marca">Marca <i class="fas fa-sort"></i></th>
                                    <th class="sortable p-2" data-column="veiculo">Modelo<i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="combustivel">Comb <i
                                            class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="ano/mod">Ano_Mod <i
                                            class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="chassi">Chassi <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="cor">Cor <i class="fas fa-sort"></i></th>
                                    <th class="sortable p-2" data-column="pts">Pts <i class="fas fa-sort"></i></th>
                                    <th class="sortable p-2" data-column="custo">Custo <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="tabela">Tabela <i class="fas fa-sort"></i>
                                    </th>
                                    <th class="sortable p-2" data-column="faturado">Estoque<i
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
                                } elseif ($veiculo->local == 'Consignado') {
                                $rowColor = 'text-green-500';
                                }
                                @endphp
                                <tr class="hover:bg-gray-100 {{ $rowColor }}">
                                    <td class="p-2">{{ $veiculo->marca }}</td>
                                    <td class="p-2">{{ $veiculo->desc_veiculo }}</td>
                                    <td class="p-2">{{ $veiculo->combustivel }}</td>
                                    <td class="p-2">{{ $veiculo->Ano_Mod }}</td>
                                    <td class="p-2">{{ $veiculo->chassi }}</td>
                                    <td class="p-2">{{ $veiculo->cor }}</td>
                                    <td class="p-2">{{ $veiculo->portas }}</td>
                                    <td class="p-2">{{ number_format($veiculo->vlr_tabela, 0, ',', '.') }}</td>
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
                <span class="filter text-green-500 font-semibold" data-filter="Consignado"
                    style="cursor: pointer;">Consignado</span>
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
            window.location.href = "{{ route('veiculos.usados.index') }}?" + params.toString();
        }

        function atualizarValores() {
            let minValor = document.getElementById('minValor');
            let maxValor = document.getElementById('maxValor');
            let minValorLabel = document.getElementById('minValorLabel');
            let maxValorLabel = document.getElementById('maxValorLabel');

            // Se o mínimo for maior que o máximo, ajusta automaticamente
            if (parseInt(minValor.value) > parseInt(maxValor.value)) {
                minValor.value = maxValor.value;
            }

            // Atualiza os rótulos na tela
            minValorLabel.innerText = 'Min R$ ' + parseFloat(minValor.value).toLocaleString('pt-BR', {
                minimumFractionDigits: 2
            });
            maxValorLabel.innerText = 'Max R$ ' + parseFloat(maxValor.value).toLocaleString('pt-BR', {
                minimumFractionDigits: 2
            });
        }

        function aplicarFiltroPreco() {
            let min = document.getElementById('minValor').value;
            let max = document.getElementById('maxValor').value;
            window.location.href = "{{ url('/usados') }}?valor_min=" + min + "&valor_max=" + max;
        }

        function limparFiltros() {
            // Redireciona para a página sem parâmetros de filtro
            window.location.href = window.location.pathname;
        }

        document.addEventListener("DOMContentLoaded", function() {
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
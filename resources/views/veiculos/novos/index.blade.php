<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-4 max-w-7xl mx-auto">
            <!-- Carrossel de Veículos -->
            <div class="swiper mySwiper bg-white shadow-lg rounded-lg overflow-hidden w-1/2"
                title="Clique sobre o veiculo para filtrar todos os modelos de sua Família.">
                <div class="swiper-wrapper">
                    @foreach ($imagens as $imagem)
                        @php
                            $familia = ucfirst(pathinfo(basename($imagem), PATHINFO_FILENAME));
                        @endphp
                        <div>
                            <div class="swiper-slide text-center">
                                <a href="{{ route('veiculos.novos.filtro', ['familia' => $familia]) }}">
                                    <img src="{{ asset('images/familia/' . basename($imagem)) }}" alt="Imagem do Veículo"
                                        class="rounded-lg w-full object-cover">
                                    <div class="text-sm font-semibold mt-2 text-center">{{ $familia }}</div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Botões de navegação -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            <!-- ComboBox (Desc Veículo  = Modelo) -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col w-1/6">
                <div class="flex flex-col gap-2">
                    <span class="text-xl font-semibold text-center">Modelo</span>
                    <select id="modeloVeiculo"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled selected>Selecione</option>
                        @foreach ($veiculosUnicos as $veiculo)
                            <option value="{{ $veiculo->desc_veiculo }}">{{ $veiculo->desc_veiculo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Card da Pesquisa -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col w-1/2">
                <!-- Título do ComboBox (Combustivel) -->
                <div class="flex items-center gap-4">
                    <span class="text-xl font-semibold">Combustível</span>
                    <select name="ano_modelo"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Gasolina">Gasolina</option>
                        <option value="Alcool">Alcool</option>
                        <option value="Flex">Flex</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Eletrico">Eletrico</option>
                    </select>
                </div>

                <!-- Título do ComboBox (Ano/Modelo) -->
                <div class="flex items-center gap-4">
                    <span class="text-xl font-semibold">Ano/Modelo</span>
                    <select name="ano_modelo"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="2024/2024">2024/2024</option>
                        <option value="2024/2025">2024/2025</option>
                        <option value="2025/2025">2025/2025</option>
                        <option value="2025/2026">2025/2026</option>
                    </select>
                </div>
            </div>
        </div>
    </x-slot>

    <div> <!-- class="py-1"> -->
        <div class="w-full max-w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="p-6 text-gray-900">
                        <div style="max-height: 400px; overflow-y: auto;"> <!-- Container para rolagem -->
                            <table class="table-auto w-full">
                                <thead class="bg-gray-100 text-left sticky top-0 z-10">
                                    <tr>
                                        <th class="sortable p-2" data-column="veiculo">Veículo <i
                                                class="fas fa-sort"></i></th>
                                        <th class="sortable p-2" data-column="modelo">Modelo <i class="fas fa-sort"></i>
                                        </th>
                                        <th class="sortable p-2" data-column="combustivel">Comb <i
                                                class="fas fa-sort"></i></th>
                                        <th class="sortable p-2" data-column="ano_mod">Ano_Mod <i
                                                class="fas fa-sort"></i></th>
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
                                                class="fas fa-sort"></i></th>
                                        <th class="hidden">Local</th> <!-- Coluna oculta -->
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    @foreach ($veiculos as $veiculo)
                                        {{-- Coloca a cor na linha com base na coluna local --}}
                                        @php
                                            // Define a cor da linha com base no valor da coluna 'local'
                                            $rowColor = '';
                                            if ($veiculo->local == 'Matriz') {
                                                $rowColor = 'text-black'; // Matriz mantém a cor preta
                                            } elseif ($veiculo->local == 'Filial') {
                                                $rowColor = 'text-yellow-500'; // Filial em amarelo
                                            } elseif ($veiculo->local == 'Transito') {
                                                $rowColor = 'text-green-500'; // Trânsito em verde
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
                                            <td class="p-2">{{ number_format($veiculo->vlr_tabela, 0, ',', '.') }}
                                            </td>
                                            <td class="p-2">{{ number_format($veiculo->vlr_bonus, 0, ',', '.') }}
                                            </td>
                                            <td class="p-2">{{ number_format($veiculo->vlr_nota, 0, ',', '.') }}
                                            </td>
                                            <td class="p-2">
                                                {{ \Carbon\Carbon::parse($veiculo->dta_faturamento)->diffInDays(now()) }}
                                                dias
                                            </td>
                                            <td class="hidden">{{ $veiculo->local }}</td> <!-- Coluna oculta -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Barra fixa abaixo da tabela -->
    <!-- Barra fixa abaixo da tabela com linha de divisão acima -->
    <div class="fixed bottom-0 left-0 w-full bg-white shadow-lg p-2 border-t border-gray-300">
        <div class="flex justify-between items-center">
            <!-- Número de veículos selecionados -->
            <div class="text-lg font-semibold" id="selectedVehiclesCount">
                Veículos Listados: {{ count($veiculos) }}
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

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inicializa o Swiper
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 4,
                spaceBetween: 0,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

            // Função para selecionar o modelo do veículo e redirecionar
            document.getElementById('modeloVeiculo').addEventListener('change', function() {
                var veiculoSelecionado = this.value;
                if (veiculoSelecionado) {
                    window.location.href = "{{ url('/novos/index') }}/" + veiculoSelecionado;
                }
            });

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



        });
    </script>
</x-app-layout>

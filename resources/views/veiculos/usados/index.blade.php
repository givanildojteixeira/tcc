<x-app-layout>
    <!-- VEICULOS USADOS FILTRO PRINCIPAL-->
    <x-slot name="header">
        <div class="flex gap-1 p-2">
            <!-- Card para Pesquisas Combinadas -->
            <div class="relative bg-white shadow-lg rounded-lg overflow-hidden w-2/3 p-1 px-1 py-1">
                <div class="grid grid-cols-3 gap-1 px-1 py-1 items-center content-center h-full">

                    <!-- ComboBox Marca -->
                    <div class="flex items-center gap-1 px-1 py-1">
                        <span class="font-semibold text-gray-600"><strong>Família:</strong></span>
                        <select id="marcaVeiculo"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('marca', this.value)">
                            <option value="" {{ empty(session('marca_selecionado')) ? 'selected' : '' }}>Todos
                            </option>
                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->marca }}" {{ session('marca_selecionado') == $marca->marca ?
                                    'selected' : '' }}>
                                    {{ $marca->marca }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ComboBox Modelo -->
                    <div class="flex items-center gap-1 px-1 py-1">
                        <span class="text-xs font-semibold text-gray-600">Modelo:</span>
                        <select id="modeloVeiculo"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('modelo', this.value)">
                            <option value="" {{ empty(session('modelo_selecionado')) ? 'selected' : '' }}>
                                Todos</option>
                            @foreach ($veiculosUnicos as $veiculo)
                                <option value="{{ $veiculo->desc_veiculo }}" {{ session('modelo_selecionado') == $veiculo->
                                    desc_veiculo ? 'selected' : '' }}>
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
        Todos
    </option>
    @foreach ($combustiveis as $combustivel)
        <option value="{{ $combustivel->combustivel }}"
            {{ session('combustivel_selecionado') == $combustivel->combustivel ? 'selected' : '' }}>
            {{ $combustivel->combustivel }}
        </option>
    @endforeach
</select>

                    </div>

                    <!-- Cores Veículos -->
                    <div class="flex items-center gap-1 px-1 py-1">
                        <span class="text-xs font-semibold text-gray-600">Cor:</span>
                        <select id="corVeiculo"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('cor', this.value)">
                            <option value="" {{ empty(session('cor_selecionado')) ? 'selected' : '' }}>
                                Todos</option>
                            @foreach ($cores as $cor)
                                <option value="{{ $cor->cor }}" {{ session('cor_selecionado') == $cor->cor ? 'selected' : ''
                                                                                }}>
                                    {{ $cor->cor }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Ano_Mod Veículos -->
                    <div class="flex items-center gap-1 px-1 py-1">
                        <span class="text-xs font-semibold text-gray-600">Ano/Modelo:</span>
                        <select id="anoVeiculo"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            onchange="atualizarFiltro('ano', this.value)">
                            <option value="" {{ empty(session('ano_selecionado')) ? 'selected' : '' }}>
                                Todos</option>
                            @foreach ($anos as $ano)
                                                    <option value="{{ $ano['Ano_Mod'] }}" {{ session('ano_selecionado') == $ano['Ano_Mod']
                                ? 'selected' : '' }}>
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
        <option value="" {{ empty(session('portas_selecionado')) ? 'selected' : '' }}>Todos</option>
        @foreach ($portas as $qtd)
            <option value="{{ $qtd->portas }}"
                {{ session('portas_selecionado') == $qtd->portas ? 'selected' : '' }}>
                {{ $qtd->portas }}
            </option>
        @endforeach
    </select>
</div>

                </div>
            </div>

            {{-- Bloco de pesquisa especifica --}}
            <div class="flex justify-center bg-white shadow-lg rounded-lg overflow-hidden w-1/3 p-1 px-1 py-1">
                <div class="flex flex-col w-full">
                    <!-- Campo de Pesquisa Chassi com Botão -->
                    <div class="flex items-center gap-1 px-1 py-1 mb-4">
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
                    <div class="flex items-center justify-between gap-1 px-1 py-1 w-full text-xs text-gray-600">
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

    <div>
        <!-- Tabela de dados -->
        <div class="w-full max-w-full p-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="text-gray-900" id="tabela-wrapper">
                        <div x-data="{ open: false, veiculo: {} }" x-init=" @if (request('openModal') && request('veiculo_id')) $nextTick(() => {
                        document.getElementById('veiculo-{{ request('veiculo_id') }}')?.click(); }); @endif">
                            <table class="w-full table-auto">
                                <thead class="bg-gray-100 text-left sticky top-0 z-10">
                                    <tr>
                                        <th class="sortable p-1 px-1 py-1" data-column="marca">Marca <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i></th>
                                        <th class="sortable p-1 px-1 py-1" data-column="veiculo">Modelo<i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i> </th>
                                        <th class="sortable p-1 px-1 py-1" data-column="combustivel">Comb <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i> </th>
                                        <th class="sortable p-1 px-1 py-1" data-column="ano/mod">Ano/Modelo <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i> </th>
                                        <th class="sortable p-1 px-1 py-1" data-column="chassi">Chassi <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i> </th>
                                        <th class="sortable p-1 px-1 py-1" data-column="chassi">Placa <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i> </th>
                                        <th class="sortable p-1 px-1 py-1" data-column="cor">Cor <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i></th>
                                        <th class="sortable p-1 px-1 py-1" data-column="pts">Portas<i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i></th>
                                        <th class="sortable p-1 px-1 py-1 text-right" data-column="tabela">Valor FIPE <i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        @acessoGerente
                                        <th class="sortable p-1 px-1 py-1 text-right" data-column="custo">Valor Compra
                                            <i class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        @endacessoGerente
                                        <th class="sortable p-1 px-1 py-1 text-right" data-column="custo">Valor Venda<i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="sortable p-1 px-1 py-1 text-right" data-column="custo">Vendedor<i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>

                                        <th class="sortable p-1 px-1 py-1" data-column="faturado">Estoque<i
                                                class="fas fa-sort text-gray-400 text-xs ml-1"></i>
                                        </th>
                                        <th class="hidden">Local</th> <!-- Coluna oculta -->
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    @foreach ($veiculos as $veiculo)
                                    @php

                                        // Cores de fundo baseadas em status/promoção
                                        if ($veiculo->promocao) {
                                            $bgColor = 'bg-blue-500 group hover:bg-blue-600 font-bold';
                                        } elseif (!$veiculo->ativo) {
                                            $bgColor = 'bg-gray-500 group hover:bg-gray-600';
                                        } elseif ($veiculo->status == 'negociacao') {
                                            $bgColor = 'bg-red-500 group hover:bg-red-600';
                                        } elseif ($veiculo->status == 'entrada') {
                                            $bgColor = 'bg-gray-500 group hover:bg-gray-600';
                                        } else {
                                            $bgColor = 'bg-white group hover:bg-gray-100';
                                        }

                                        // Cores de texto baseadas no local
                                        if ($veiculo->local == 'Matriz') {
                                            $textColor = 'text-black';
                                        } elseif ($veiculo->local == 'Filial') {
                                            $textColor = 'text-yellow-500';
                                        } elseif ($veiculo->local == 'Consignado') {
                                            $textColor = 'text-green-500';
                                        } else {
                                            $textColor = '';
                                        }

                                        // Combina tudo, para que nao ocorra sobreposição de código
                                        $rowColor = "$bgColor $textColor";



                                        $descricaoOpcional =
                                            \App\Models\Opcionais::where('chassi', $veiculo->chassi)->value(
                                                'descricao',
                                            ) ?? 'Nenhum opcional cadastrado.';
                                    @endphp
                                    <tr id="veiculo-{{ $veiculo->id }}"
                                        class="cursor-pointer {{ $bgColor }} {{ $textColor }}" @click=" open = true;
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
                                                placa: '{{ $veiculo->placa }}',
                                                cor: '{{ $veiculo->cor }}',
                                                portas: '{{ $veiculo->portas }}',
                                                cod_opcional: '{{ $veiculo->cod_opcional }}',
                                                vlr_tabela: '{{ number_format($veiculo->vlr_tabela, 0, ',', '.') }}',
                                                {{-- vlr_bonus: '{{ number_format($veiculo->vlr_bonus, 0, ',', '.') }}', --}}
                                                vlr_nota: '{{ number_format($veiculo->vlr_nota, 0, ',', '.') }}',
                                                faturado: '{{ \Carbon\Carbon::parse($veiculo->dta_faturamento)->diffInDays(now()) }}',
                                                {{-- Essa linha leva a origem para o modal, assim ele saberá como voltar --}}
                                                origem: 'usados' } " {{--
                                        @dblclick="window.location.href = '{{ route('veiculos.edit', ['id' => $veiculo->id]) }}?from=usados'">
                                        --}}
                                        >
                                        <td class="p-1 px-1 py-1">{{ $veiculo->marca }}</td>
                                        <td class="p-1 px-1 py-1">
                                            @if ($veiculo->promocao)
                                                <span class="ml-1 text-blue-600 font-bold"
                                                    title="Veículo em promoção">🔥</span>
                                            @endif{{ $veiculo->desc_veiculo }}
                                        </td>
                                        <td class="p-1 px-1 py-1">{{ $veiculo->combustivel }}</td>
                                        <td class="p-1 px-1 py-1 text-center">{{ $veiculo->Ano_Mod }}</td>
                                        <td class="p-1 px-1 py-1">{{ $veiculo->chassi }}</td>
                                        <td class="p-1 px-1 py-1">{{ $veiculo->placa }}</td>
                                        <td class="p-1 px-1 py-1">{{ $veiculo->cor }}</td>
                                        <td class="p-1 px-1 py-1  text-center">{{ $veiculo->portas }}</td>
                                        <td class="p-1 px-1 py-1 text-right">
                                            {{ number_format($veiculo->vlr_tabela, 0, ',', '.') }}
                                        </td>
                                        @acessoGerente
                                        <td class="p-1 px-1 py-1 text-right">
                                            {{ number_format($veiculo->vlr_nota, 0, ',', '.') }}
                                        </td>
                                        @endacessoGerente
                                        <td class="p-1 px-1 py-1 text-right">
                                            {{ number_format($veiculo->vlr_bonus, 0, ',', '.') }}
                                        </td>
                                        {{-- vendedor --}}
                                        <td class="p-1 px-1 py-1">
                                            {{ Str::before($veiculo->vendedor->name ?? '---', ' ') }}
                                        </td>


                                        <td class="p-1 px-1 py-1 text-center">
                                            {{ \Carbon\Carbon::parse($veiculo->dta_faturamento)->diffInDays(now()) }}
                                            dias
                                        </td>
                                        <td class="hidden">{{ $veiculo->local }}</td>
                                        <td class="hidden">{{ $veiculo->status }}</td>
                                        {{-- <td>{{ $veiculo->local }}</td> --}}
                                        {{-- <td>{{ $veiculo->status }}</td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- ✅ Modal de Detalhes -->
                            @include('veiculos.modal.veiculo', ['tipo' => 'Usado'])
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

            <div class="flex flex-wrap gap-1 items-center">
                <span class="font-medium">Legenda Cores:</span>
                <span class="font-medium">Status =&gt; [</span>
                {{-- Coluna 14 --}}
                <span class="filter font-semibold text-red-500 cursor-pointer"
                    data-filter="negociacao">Negociação</span> |
                <span class="filter font-semibold text-gray-500 cursor-pointer"
                    data-filter="indisponivel">Entrada</span> |
                <span class="filter font-semibold text-blue-500 cursor-pointer" data-filter="promocao">Promoção</span> |
                <span class="font-medium">] Localização =&gt; [</span>
                {{-- Coluna 13 --}}
                <span class="filter font-semibold text-black cursor-pointer" data-filter="Matriz">Matriz</span> |
                <span class="filter font-semibold text-yellow-500 cursor-pointer" data-filter="Filial">Filial</span> |
                <span class="filter font-semibold text-green-500 cursor-pointer"
                    data-filter="Consignado">Consignação</span>
                <span class="font-medium">] </span>
            </div>




        </x-rodape>

        <!-- Modal de Ajuda -->
        <div id="modalAjuda" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full p-6 relative flex gap-6 animate-shake border-t-4 border-blue-400">
                <!-- Ícone  -->
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white p-2 rounded-full shadow">
                    <i class="fas fa-info-circle text-blue-500 text-4xl"></i>
                </div>

                <!-- Conteúdo do Modal -->
                <div class="flex-1 relative">
                    <!-- Botão de Fechar -->
                    <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                        class="absolute top-0 right-0 text-red-500 hover:text-red-700 text-2xl">
                        &times;
                    </button>

                    <h2 class="text-2xl font-bold text-blue-600 mb-4">Instruções da Tela de Veículos Semi-Novos</h2>

                    <p class="mb-3 text-sm text-gray-700 leading-relaxed">
                        Esta tela tem como objetivo <strong>exibir e filtrar veículos Semi-Novos</strong> disponíveis no
                        estoque,
                        tanto da Matriz quanto das filias ou até mesmo em consignação que são os veiculos que nao fazem
                        parte do
                        estoque da empresa, por serem veiculos, que os clientes deixaram para vender.
                        Utilize os recursos abaixo para uma busca eficaz:
                    </p>

                    <ul class="list-disc list-inside text-sm text-gray-800 space-y-2">
                        <li><strong>Combos de Filtro:</strong> Utilize as caixas Marca, Modelo, Combustível, Ano/Modelo,
                            Portas ou Cor
                            para refinar sua busca. </li>
                        <li><strong>Busca por Chassi:</strong> É uma pesquisa direta, sem filtro, que permite localizar
                            veículos digitando parte do número do
                            chassi.</li>
                        <li><strong>Busca por Faixa de Valor:</strong> É uma pesquisa direta, sem filtro, que permite
                            localizar veículos tendo como base seu valor Minimo
                            e máximo, ao preço de tabela do semi-novo.</li>
                        <li><strong>Legenda de Cores:</strong> Indica a localização dos veículos: <span
                                class="text-black font-bold">Matriz</span>, <span
                                class="text-yellow-500 font-bold">Filial</span> ou <span
                                class="text-green-500 font-bold">Consignação</span>
                            , clique sobre eles para refinar ainda mais sua busca.</li>
                        <li><strong>Legenda de Status:</strong> Indica o status dos veículos: <span
                            class="text-red-500 font-bold">Negociação</span>: veículo ainda nao vendido mas ja incluso em uma outra proposta aprovada, <span
                            class="text-gray-500 font-bold">Entrada</span>: veículo usado prestes a entrar no estoque, mas ainda dependente de concretização
                            de uma proposta de venda, ou <span
                            class="text-blue-500 font-bold">Promoção</span>: veículo marcado devido a vantagem de negócio, ou benefício de venda
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
            // Torna a função global para uso em atributos inline (onchange)
            window.atualizarFiltro = function (chave, valor) {
                let params = new URLSearchParams(window.location.search);
                if (valor) {
                    params.set(chave, valor);
                } else {
                    params.delete(chave);
                }
                window.location.href = "{{ route('veiculos.usados.index') }}?" + params.toString();
            };

            // Redireciona para limpar todos os filtros
            function limparFiltros() {
                window.location.href = "{{ route('veiculos.usados.limparFiltros') }}";
            }

            function gerarRelatorio() {
                const url = new URL(window.location.href);
                url.searchParams.set('relatorio', '1');
                window.location.href = url.toString();
            }

            document.addEventListener("DOMContentLoaded", function () {
                // Filtro por faixa de valor
                const slider = document.getElementById('slider-preco');
                const sliderStart = [
                    {{ session('valor_min', 0) }},
                    {{ session('valor_max', 1000000) }}
                ];

                noUiSlider.create(slider, {
                    start: sliderStart,
                    connect: true,
                    step: 1000,
                    range: {
                        'min': 0,
                        'max': 1000000
                    },
                    format: {
                        to: value => parseInt(value),
                        from: value => parseInt(value)
                    }
                });

                const minLabel = document.getElementById('minValorLabel');
                const maxLabel = document.getElementById('maxValorLabel');

                slider.noUiSlider.on('update', function (values) {
                    minLabel.innerText = `R$ ${parseInt(values[0]).toLocaleString('pt-BR')}`;
                    maxLabel.innerText = `R$ ${parseInt(values[1]).toLocaleString('pt-BR')}`;
                });

                window.aplicarFiltroPreco = function () {
                    const valores = slider.noUiSlider.get();
                    const params = new URLSearchParams(window.location.search);
                    params.set('valor_min', valores[0]);
                    params.set('valor_max', valores[1]);
                    window.location.href = "{{ route('veiculos.usados.index') }}?" + params.toString();
                };

                // Ordenação da tabela
                const headers = document.querySelectorAll('.sortable');
                let sortDirection = 'asc';

                headers.forEach(header => {
                    const icon = header.querySelector('i');
                    icon?.classList.add('fa-sort');

                    header.addEventListener('click', () => {
                        const column = header.getAttribute('data-column');
                        sortTable(column, sortDirection);
                        sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';

                        headers.forEach(h => h.querySelector('i')?.classList.remove('fa-sort-up',
                            'fa-sort-down'));
                        headers.forEach(h => h.querySelector('i')?.classList.add('fa-sort'));

                        const currentIcon = header.querySelector('i');
                        currentIcon.classList.remove('fa-sort');
                        currentIcon.classList.add(sortDirection === 'asc' ? 'fa-sort-up' :
                            'fa-sort-down');

                        headers.forEach(h => h.classList.remove('sorted'));
                        header.classList.add('sorted');
                    });
                });

                function sortTable(column, direction) {
                    const rows = Array.from(document.querySelectorAll('tbody tr'));
                    const index = Array.from(headers).findIndex(header => header.getAttribute('data-column') ===
                        column);
                    const isNumeric = ['pts', 'tabela', 'bonus', 'custo', 'faturado'].includes(column);

                    rows.sort((a, b) => {
                        const cellA = a.cells[index].textContent.trim();
                        const cellB = b.cells[index].textContent.trim();
                        const valA = isNumeric ? parseFloat(cellA.replace(/[^\d.-]/g, '')) : cellA
                            .toLowerCase();
                        const valB = isNumeric ? parseFloat(cellB.replace(/[^\d.-]/g, '')) : cellB
                            .toLowerCase();
                        return direction === 'asc' ? (valA < valB ? -1 : 1) : (valA > valB ? -1 : 1);
                    });

                    const tbody = document.querySelector('tbody');
                    rows.forEach(row => tbody.appendChild(row));
                }

                // Filtro por local
                let activeFilter = null;
                document.querySelectorAll('.filter').forEach(el => {
                    el.addEventListener('click', function () {
                        const filtro = this.getAttribute('data-filter');
                        activeFilter = activeFilter === filtro ? null : filtro;
                        applyFilter();
                    });
                });

                function applyFilter() {
                    const rows = document.querySelectorAll('tbody tr');
                    let count = 0;



                    // Exiba apenas as linhas que correspondem ao filtro ativo
                    if (activeFilter === 'Matriz' || activeFilter === 'Filial' || activeFilter === 'Consignado') {
                        rows.forEach(row => {
                            const local = row.querySelector('td:nth-child(14)').textContent.trim();

                            if (local === activeFilter) {
                                row.style.display = '';
                                count++;
                            } else {
                                row.style.display = 'none';
                            }
                        });

                    } else {
                        rows.forEach(row => {
                            const status = row.querySelector('td:nth-child(15)').textContent.trim();
                            console.log(' activeFilter:', activeFilter, '| linha status:', status);
                            if (status === activeFilter) {
                                row.style.display = '';
                                count++;
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    }

                    document.getElementById('selectedVehiclesCount').textContent =
                        activeFilter ? `Filtro Aplicado [${activeFilter}] - Veículos listados: ${count}` :
                            `Veículos Listados: ${count}`;
                }
            });
        </script>

</x-app-layout>
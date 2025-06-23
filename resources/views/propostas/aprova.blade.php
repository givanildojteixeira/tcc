{{-- Cabeçalho com logo e título --}}
<div class="flex items-center justify-between ">
    <div class="flex items-center space-x-4">
        <h1 class="text-2xl font-bold text-gray-800"> 📝 Proposta de Venda de Veículo Nro:
            <strong>{{ $proposta['id'] }}</strong>
        </h1>
    </div>
</div>
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
    <div class="px-4 print:px-0 print:max-h-full print:overflow-visible max-h-[85vh] overflow-y-auto">


        <!-- Cliente -->
        <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm mb-1">
            <legend class="text-green-700 text-sm font-medium px-2">Informações da proposta</legend>
            <ul class="text-sm text-gray-800">
                <li>
                    <strong>Cliente:</strong> {{ $cliente->nome }}
                    <strong class="ml-2">CPF/CNPJ:</strong> {{ $cliente->cpf_cnpj }}
                    <strong>Endereço:</strong> {{ $cliente->endereco ?? '-' }},
                    {{ $cliente->cidade ?? '-' }}/{{ $cliente->uf ?? '-' }}
                </li>
            </ul>
        </fieldset>

        <!-- Veículo Novo -->
        <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm mb-1">
            <legend class="text-green-700 text-sm font-medium px-2">Veículo novo/usado incluso na proposta</legend>
            <ul class="text-sm text-gray-800">
                <li>
                    <strong>Veículo:</strong> {{ $veiculo->marca }} - {{ $veiculo->desc_veiculo }} -
                    {{ $veiculo->motor }} - {{ $veiculo->cor }} -
                    {{ $veiculo->combustivel }}
                    <strong>Chassi:</strong> {{ $veiculo->chassi }}
                    <strong>Valor Tabela:</strong> R$
                    {{ number_format($veiculo->vlr_tabela, 2, ',', '.') }}
                </li>
            </ul>
        </fieldset>

        <!-- Veículo Usado -->
        @if ($veiculoUsado)
            <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm mb-1">
                <legend class="text-green-700 text-sm font-medium px-2">Veículo usado incluso na proposta</legend>
                <div class="grid grid-cols-3 text-sm text-gray-800">
                    <div><strong>Veículo:</strong> {{ $veiculoUsado->marca }} - {{ $veiculoUsado->desc_veiculo }}
                        -
                        {{ $veiculoUsado->motor }} - {{ $veiculoUsado->cor }} -
                        {{ $veiculoUsado->combustivel }}
                    </div>
                    <div><strong>Chassi:</strong> {{ $veiculoUsado->chassi }}</div>
                    <div><strong>Valor Avaliação:</strong> R$
                        {{ number_format($veiculoUsado->vlr_tabela, 2, ',', '.') }}
                    </div>
                </div>
            </fieldset>
        @endif

        <!-- Negociações e Resumo lado a lado -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 items-stretch">
            @if (!empty($negociacoes))
                <fieldset class="border border-green-400 bg-green-50 rounded-md px-4 py-2 bg-gray-50 h-full">
                    <legend class="text-green-700 font-semibold text-sm px-2">Negociações Adicionadas
                    </legend>
                    <table class="w-full text-sm text-left border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-2 py-1 border text-center">Condição</th>
                                <th class="px-2 py-1 border text-center">Valor</th>
                                <th class="px-2 py-1 border text-center">Vencimento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($negociacoes as $n)
                                <tr>
                                    <td class="px-2 py-1 border">{{ $n['condicao_texto'] ?? $n['condicao'] }}
                                    </td>
                                    <td class="px-2 py-1 border text-right">R$
                                        {{ number_format($n['valor'], 2, ',', '.') }}
                                    </td>
                                    <td class="px-2 py-1 border text-center">
                                        {{ \Carbon\Carbon::parse($n['vencimento'])->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @php
                            $total = collect($negociacoes)
                                ->reject(fn($n) => in_array($n['condicao_texto'] ?? $n['condicao'], ['Desconto(-)', 'Troco na Troca (-)', 'Acréscimo(+)']))
                                ->sum('valor');
                        @endphp

                        <tfoot class="bg-gray-100">
                            <tr>
                                <td class="px-2 py-1 border font-semibold text-right" colspan="1">Total:</td>
                                <td class="px-2 py-1 border font-bold text-right text-green-700" colspan="2">
                                    R$ {{ number_format($total, 2, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </fieldset>
            @endif

            <!-- Resumo Financeiro -->
            <fieldset class="border border-green-400 bg-green-50 rounded-md px-4 py-2 bg-gray-50 h-full">
                <legend class="text-green-700 font-semibold text-sm px-2">Resumo Financeiro</legend>
                <div class="text-sm text-gray-800 space-y-1">
                    <div class="flex justify-between">
                        <span>Valor da Proposta:</span>
                        <span>R$ {{ number_format($veiculo->vlr_tabela ?? 0, 2, ',', '.') }}</span>
                    </div>

                    @php
                        $vlrDesconto = collect($negociacoes)
                            ->filter(fn($n) => in_array($n['condicao_texto'] ?? $n['condicao'], ['Desconto(-)', 'Troco na Troca (-)']))
                            ->sum('valor');
                        $vlrAcrescimo = collect($negociacoes)
                            ->filter(fn($n) => in_array($n['condicao_texto'] ?? $n['condicao'], ['Acréscimo(+)']))
                            ->sum('valor');

                    @endphp

                    <div class="flex justify-between">
                        <span>Desconto:</span>
                        <span>R$ {{ number_format($vlrDesconto, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Acréscimo:</span>
                        <span>R$ {{ number_format($vlrAcrescimo, 2, ',', '.') }}</span>
                    </div>

                    @php
                        $vlrNota = ($veiculo->novo_usado === 'Novo') ? ($veiculo->vlr_nota ?? 0) : ($veiculo->vlr_tabela + $vlrAcrescimo ?? 0);
                    @endphp

                    <div class="flex justify-between">
                        <span>Valor Nota:</span>
                        <span>R$ {{ number_format($vlrNota ?? 0, 2, ',', '.') }}</span>
                    </div>
                    @php
                        $bonus = ($veiculo->novo_usado === 'Novo') ? ($veiculo->vlr_bonus ?? 0) : 0;
                    @endphp

                    <div class="flex justify-between">
                        <span>Bônus:</span>
                        <span>R$ {{ number_format($bonus, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Usado(s):</span>
                        <span>R$ {{ number_format($proposta['valor_veiculoUsado'] ?? 0, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-semibold text-green-700">
                        <span>Lucro Estimado:</span>
                        <span>
                            R$
                            @if ($veiculo->novo_usado === 'Novo')
                                                        {{ number_format(
                                    ($veiculo->vlr_tabela ?? 0)
                                    - ($proposta['vlr_desconto'] ?? 0)
                                    - ($veiculo->vlr_bonus ?? 0)
                                    - ($veiculo->vlr_nota ?? 0),
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            @else
                                                        {{ number_format(
                                    ($veiculo->vlr_tabela ?? 0)
                                    + ($vlrDesconto ?? 0)
                                    - ($vlrNota ?? 0),
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            @endif
                        </span>
                    </div>

                </div>
            </fieldset>
        </div>

    </div>

    <!-- Grupo de Botões Centralizados -->
    <div class="flex justify-center gap-4 mt-6 flex-wrap">
        <x-bt-padrao label="Fechar" color="gray" icon="arrow-left" title="Fechar" @click="showModalAprovar = false" />

        <x-bt-padrao label="📝 Ver Observações" color="yellow" icon="" title="Observações"
            @click="showModalObservacao = true" />

        <x-bt-padrao label="👥 Ver Aprovações" color="blue" title="Ver quem aprovou a proposta"
            @click="carregarAprovadores({{ $proposta['id'] }})" />


        <x-bt-padrao label="❌ Rejeitar" color="red" icon="" title="Devolve a proposta ao vendedor"
            @click="alterarCampoProposta({{ $proposta['id'] }}, 'status', 'rejeitada')" />

        {{-- Aprovações --}}
        @php
            $nivel = strtolower(Auth::user()->level);
        @endphp

        @if ($nivel === 'assistente')
            <x-bt-padrao label="✅ Aprovação Financeira" color="green" icon="" title="Aprovação Financeira da proposta"
                @click="alterarCampoProposta({{ $proposta['id'] }}, 'status', 'Aprovada')" />
        @elseif ($nivel === 'gerente')
            <x-bt-padrao label="✅ Aprovação Gerencial" color="green" icon="" title="Aprovação Gerencial da proposta"
                @click="aprovarGerencialmente({{ $proposta['id'] }})" />
        @elseif ($nivel === 'diretor' || $nivel === 'admin')

            <x-bt-padrao label="✅ Enviar para Faturamento" color="green" icon="" title="Envia a proposta para Faturamento."
                @click="showModalFaturar = true" />

        @endif
        {{-- Aprovações --}}

    </div>

    <!-- Modal (Observações)  -->
    <div x-show="showModalObservacao" style="display: none;"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-[9999]">
        <div
            class="bg-white rounded-md shadow-xl p-6 w-full max-w-4xl overflow-y-auto max-h-[85vh] border border-yellow-400 border-t-4 animate-shake relative">
            <button @click="showModalObservacao = false"
                class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">
                &times;
            </button>

            <h2 class="text-lg font-semibold text-blue-700 mb-3">📝 Observações da Proposta</h2>

            <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-800">
                <fieldset class="border border-blue-400 bg-blue-50 p-2 rounded-md shadow-sm">
                    <legend class="text-blue-700 text-sm font-medium px-2">Observação da Nota</legend>
                    <div class="mt-1 p-2 bg-white border border-gray-200 rounded-md min-h-[80px]">
                        {{ $proposta['observacao_nota'] ?? '---' }}
                    </div>
                </fieldset>

                <fieldset class="border border-blue-400 bg-blue-50 p-2 rounded-md shadow-sm">
                    <legend class="text-blue-700 text-sm font-medium px-2">Observação Interna</legend>
                    <div class="mt-1 p-2 bg-white border border-gray-200 rounded-md min-h-[80px]">
                        {{ $proposta['observacao_interna'] ?? '---' }}
                    </div>
                </fieldset>
            </div>
            <!-- Botão Fechar -->
            <div class="flex justify-center mt-6">
                <button @click="showModalObservacao = false"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm shadow">
                    Fechar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal: Histórico de Aprovadores -->
    <div x-show="showModalAprovadores" x-cloak
        class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-[10000]">
        <div
            class="bg-white border-2 border-green-600 rounded-lg shadow-2xl p-6 w-full max-w-xl border-t-4 animate-shake relative">
            <!-- Botão Fechar -->
            <button @click="showModalAprovadores = false"
                class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">
                &times;
            </button>

            <!-- Conteúdo -->
            <fieldset class="border border-green-400 bg-green-50 p-4 rounded-md shadow-sm">
                <legend class="text-green-700 text-sm font-semibold px-2">
                    <i class="fas fa-users mr-1"></i> Histórico de Aprovação da Proposta
                </legend>

                <ul class="text-sm text-gray-800 space-y-3 mt-2" x-show="aprovadores">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-user-tie text-green-600"></i>
                        <span><strong>Gerencial:</strong></span>
                        <span x-text="aprovadores.gerencial || '✔️ Aprovada'"></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-calculator text-yellow-600"></i>
                        <span><strong>Financeira:</strong></span>
                        <span x-text="aprovadores.gerencial || '✔️ Aprovada'"></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-university text-blue-600"></i>
                        <span><strong>Banco:</strong></span>
                        <span x-text="aprovadores.gerencial || '✔️ Aprovada'"></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-user-shield text-purple-700"></i>
                        <span><strong>Diretoria:</strong></span>
                        <span x-text="aprovadores.diretoria || '❌ Não aprovada'"></span>
                    </li>
                </ul>
            </fieldset>

            <!-- Botão Fechar centralizado -->
            <div class="flex justify-center mt-6">
                <button @click="showModalAprovadores = false"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md shadow">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal de confirmação para faturar -->
<div x-show="showModalFaturar" class="fixed inset-0 bg-black bg-opacity-50 z-[10001] flex items-center justify-center"
    style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div class="bg-white p-6 rounded-lg shadow-xl w-1/3 border-t-4 border-green-500 animate-shake relative">
        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white p-2 rounded-full shadow">
            <i class="fas fa-question-circle text-green-500 text-4xl"></i>
        </div>

        <h2 class="text-lg font-semibold text-gray-800 mt-6 text-center">Enviar para Faturamento?</h2>
        <p class="text-sm text-gray-600 text-center mb-6">
            Essa ação enviará a proposta para o setor de faturamento e marcará o veículo como vendido.
        </p>

        <div class="flex justify-center gap-4">
            <button @click="showModalFaturar = false"
                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-sm">Cancelar</button>

            <button @click="faturarProposta({{ $proposta['id'] }})"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">Sim, Faturar</button>
        </div>
    </div>
</div>
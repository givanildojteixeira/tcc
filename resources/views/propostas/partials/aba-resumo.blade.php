<!-- Esta div será rolável -->
<div class="h-full overflow-y-auto px-6 py-4 space-y-4" x-data="resumoProposta" x-init="
    carregaVeiculo();
    carregaCliente();
    carregaResumoFinanceiro();
    carregaVeiculoUsado();
">

    <!-- Resumo Cliente -->
    <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm"
        x-show="Object.keys(clienteSelecionado).length > 0">
        <legend class="text-gray-700 text-sm font-medium px-2">Cliente na proposta</legend>

        <ul class="text-sm text-gray-800 ">
            <li>
                <strong>Nome:</strong>
                <span x-text="clienteSelecionado.nome"></span>
                <strong class="ml-2">CPF/CNPJ:</strong>
                <span x-text="clienteSelecionado.cpf_cnpj"></span>
            </li>
            <li>
                <strong>Email:</strong>
                <span x-text="clienteSelecionado.email || '-'"></span>
                <strong class="ml-2">Telefone:</strong>
                <span x-text="clienteSelecionado.celular || '-'"></span>
            </li>
            <li>
                <strong>CEP:</strong>
                <span x-text="clienteSelecionado.cep || '-'"></span>
                <strong class="ml-2">Endereço:</strong>
                <span x-text="clienteSelecionado.endereco || '-'"></span>
                <strong class="ml-2">Bairro:</strong>
                <span x-text="clienteSelecionado.bairro || '-'"></span>
                <strong class="ml-2">Cidade:</strong>
                <span x-text="clienteSelecionado.cidade || '-'"></span>
                <strong class="ml-1">/</strong>
                <span x-text="clienteSelecionado.uf || '-'"></span>
            </li>
        </ul>
    </fieldset>

    <!-- Resumo  Veículo -->
    <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm"
        x-show="Object.keys(veiculo).length > 0">
        <legend class="text-gray-700 text-sm font-medium px-2">Veículo novo incluso na proposta</legend>
        <div class="grid grid-cols-3 text-sm text-gray-800 ">
            <div><strong>Marca:</strong> <span
                    x-text="veiculo.marca + ' - ' + veiculo.desc_veiculo + ' - ' + veiculo.motor"></span></div>
            <div><strong>Modelo:</strong> <span x-text="veiculo.modelo_fab"></span></div>
            <div><strong>Opcional:</strong> <span x-text="veiculo.cod_opcional"></span></div>
            <div><strong>Chassi:</strong> <span x-text="veiculo.chassi"></span></div>
            <div><strong>Valor Tabela:</strong> <span x-text="formatarValor(veiculo.vlr_tabela)"></span></div>
            <div><strong>Combustível:</strong> <span x-text="veiculo.combustivel"></span></div>
            <div><strong>Cor:</strong> <span x-text="veiculo.cor"></span></div>
            <div><strong>Local:</strong> <span x-text="veiculo.local"></span></div>
            <div><strong>Transmissão:</strong> <span x-text="veiculo.transmissao"></span></div>
        </div>
    </fieldset>

    <!-- Veículo Usado -->

    <fieldset x-if="veiculoUsado && veiculoUsado.id"
        class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm">
        <legend class="text-gray-700 text-sm font-medium px-2">Veículo Usado</legend>
        <div class="grid grid-cols-3 text-sm text-gray-800">
            <div><strong>Marca:</strong> <span
                    x-text="veiculoUsado.marca + ' - ' + veiculoUsado.desc_veiculo + ' - ' + veiculoUsado.motor"></span>
            </div>
            <div><strong>Modelo:</strong> <span x-text="veiculoUsado.modelo_fab"></span></div>
            <div><strong>Cor:</strong> <span x-text="veiculoUsado.cor"></span></div>
            <div><strong>Chassi:</strong> <span x-text="veiculoUsado.chassi"></span></div>
            <div><strong>Valor Avaliação:</strong> <span x-text="formatarValor(veiculoUsado.vlr_tabela)"></span>
            </div>
            <div><strong>Combustível:</strong> <span x-text="veiculoUsado.combustivel"></span></div>
            <div><strong>Ano:</strong> <span x-text="veiculoUsado.Ano_Mod"></span>
            </div>
            <div><strong>Placa:</strong> <span x-text="veiculoUsado.placa"></span></div>
            <div><strong>KM:</strong> <span x-text="veiculoUsado.km"></span></div>
        </div>

    </fieldset>




    <div class="flex gap-4 items-stretch">
        <!-- Negociações -->
        <div class="flex-1 min-w-[200px]">
            <template x-if="proposta.negociacoes && proposta.negociacoes.length > 0">
                <fieldset class="border border-gray-300 rounded-md px-4 pb-2 bg-gray-50 max-h-64 overflow-y-auto">
                    <legend class="text-green-700 font-semibold text-sm px-2 leading-tight">Negociações Adicionadas:
                    </legend>

                    <table class="w-full text-sm text-left border border-gray-300">
                        <thead class="bg-gray-100 sticky top-0 z-10">
                            <tr>
                                <th class="px-2 py-1 border text-center">Condição</th>
                                <th class="px-2 py-1 border text-center">Valor</th>
                                <th class="px-2 py-1 border text-center">Vencimento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(neg, index) in proposta.negociacoes" :key="index">
                                <tr :class="neg.fixo ? 'bg-blue-50' : ''">
                                    <td class="px-2 py-1 border" x-text="neg.condicao_texto"></td>
                                    <td class="px-2 py-1 border text-right" x-text="formatarValor(neg.valor)"></td>
                                    <td class="px-2 py-1 border text-center" x-text="formatarData(neg.vencimento)">
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                        <tfoot class="bg-gray-100 sticky bottom-0">
                            <tr>
                                <td class="px-2 py-1 border font-semibold text-right" colspan="1">Total:</td>
                                <td class="px-2 py-1 border font-bold text-right text-green-700" colspan="2"
                                    x-text="formatarValor(somaNegociacoes(proposta.negociacoes))">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </fieldset>
            </template>
        </div>

        <!-- Sumário -->
        <div class="sm:w-80">
            <fieldset class="border border-gray-300 rounded-md px-4 py-2 bg-gray-50 h-full">
                <legend class="text-green-700 font-semibold text-sm px-2 leading-tight">Resumo Financeiro</legend>

                <div class="text-sm text-gray-800 space-y-1">
                    <div class="flex justify-between"><span>Valor da Proposta:</span> <span
                            x-text="formatarValor(valorProposta)"></span></div>
                    <div class="flex justify-between"><span>Desconto:</span> <span
                            x-text="formatarValor(valorDesconto)"></span></div>
                    <div class="flex justify-between"><span>Custo do Item:</span> <span
                            x-text="formatarValor(custoItem)"></span></div>
                    <div class="flex justify-between"><span>Bônus:</span> <span
                            x-text="formatarValor(valorBonus)"></span></div>
                    <div class="flex justify-between"><span>Usado(s):</span> <span
                            x-text="formatarValor(valorUsado)"></span></div>
                    <div class="flex justify-between font-semibold text-green-700"><span>Lucro Estimado:</span>
                        <span x-text="formatarValor(lucroEstimado)"></span>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    <!-- Observações -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Observação da Nota -->
        <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm">
            <legend class="text-gray-700 text-sm font-medium px-2">Observação da Nota</legend>
            <div class="mt-1 p-2 bg-white border border-gray-200 rounded-md text-sm text-gray-700 min-h-[80px]">
                <span x-text="proposta.observacao_nota || '---'"></span>
            </div>
        </fieldset>

        <!-- Observação Interna -->
        <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm">
            <legend class="text-gray-700 text-sm font-medium px-2">Observação Interna</legend>
            <div class="mt-1 p-2 bg-white border border-gray-200 rounded-md text-sm text-gray-700 min-h-[80px]">
                <span x-text="proposta.observacao_interna || '---'"></span>
            </div>
        </fieldset>
    </div>


    <div class="flex justify-center items-center gap-4 mt-6">
        <!-- Botão Atualizar Resumo -->
        <button type="button" @click="
                    sessionStorage.setItem('abaAtiva', 'resumo');
                    location.reload();
                " class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 text-sm font-medium">
            🔄 Atualizar Resumo
        </button>

        <a href="{{ route('propostas.relatorioResumo') }} " target="_blank"
            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm">
            🖨️ Imprimir Resumo
        </a>

        <!-- Botão Cancelar Proposta -->
        <form method="POST" action="{{ route('proposta.cancelar') }}"
            onsubmit="return confirm('Deseja realmente cancelar esta proposta? Esta ação apagará todos os dados!');">
            @csrf
            <button type="submit"
                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 text-sm font-medium">
                ❌ Cancelar Proposta
            </button>
        </form>

        <!-- Botão Enviar Proposta -->
        <form method="POST" action="{{ route('propostas.store') }}">
            @csrf
            <!-- aqui vão seus dados da aba 'resumo' ou campos ocultos -->

            <button type="submit"
                class="bg-blue-700 text-white px-6 py-2 rounded-md hover:bg-blue-800 text-sm font-medium">
                ✅ Enviar Proposta para Aprovação
            </button>
        </form>
    </div>
</div>
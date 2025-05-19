<div x-data="negociacao" x-init="carregaNegociacao()" class="space-y-4">

    <!-- Formulário de nova negociação -->

    <div class="flex flex-wrap items-start gap-4 ">
        <!-- Fieldset da Nova Negociação -->
        <fieldset class="border border-gray-300 rounded-md p-3 bg-gray-50 flex-1 min-w-[500px]">
            <legend class="text-gray-700 text-sm font-medium px-2">Nova Negociação</legend>

            <div class="flex flex-wrap items-end gap-4">
                <!-- Condição de Pagamento -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700">Condição de Pagamento</label>
                    <select x-model="nova.condicao" class="w-48 border border-gray-300 rounded-md p-2">
                        <option disabled value="">Selecione...</option>
                        @foreach ($condicoes as $cond)
                        <option value="{{ $cond->id }}">{{ $cond->descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Valor -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700">Valor</label>
                    <input id="valorParcela"  type="number" x-model="nova.valor" step="0.01" min="0" @keydown.enter="adicionar"
                        class="w-36 border border-gray-300 rounded-md p-2">
                </div>
                <button id="ColocaDiferenca" type="button"
                    @click="nova.valor = Math.abs(diferencaValor()).toFixed(2)"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700"
                    title="Clique aqui para inserir no campo o valor da diferença.">
                    $
                </button>

                <!-- Vencimento -->
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700">Data de Vencimento</label>
                    <input type="date" x-model="nova.vencimento" class="w-22 border border-gray-300 rounded-md p-2">
                </div>

                <!-- Botão -->
                <div class="flex items-end gap-2">
                    <button type="button" @click="adicionar"
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                        ➕Adicionar Condição
                    </button>
                    <button type="button"
                        @click="window.location.href = '{{ route('propostas.create', ['aba' => 'negociacao']) }}'"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        🔄 Atualizar
                    </button>
                </div>
            </div>
        </fieldset>

        <!-- Fieldset com Totais -->
        <fieldset class="border border-gray-300 rounded-md p-3 bg-gray-50 min-w-[240px] self-end">
            <legend class="text-gray-700 text-sm font-medium px-2">Totais</legend>

            <!-- Valor da Proposta -->
            <div class="text-sm flex justify-between font-semibold"
                :class="temAcrescimo() ? 'text-blue-600' : 'text-gray-800'">
                <span>Valor da Proposta:</span>
                <span x-text="formatarValor(valorTotalProposta)"></span>
            </div>

            <!-- Soma das Condições -->
            <div class="text-sm flex justify-between font-semibold" :class="somaNegociacoes() > valorTotalProposta
        ? 'text-red-600'
        : (somaNegociacoes() == valorTotalProposta
            ? 'text-green-600'
            : 'text-gray-800')">
                <span>Soma das Condições:</span>
                <span x-text="formatarValor(somaNegociacoes())"></span>
            </div>

            <!-- Diferença -->
            <div id="valorDiferenca"  class="text-sm flex justify-between font-semibold" :class="diferencaValor() > 0
        ? 'text-red-600'
        : (diferencaValor() < 0
            ? 'text-blue-600'
            : 'text-green-600')">
                <span>Diferença:</span>
                <span x-text="formatarValor(Math.abs(diferencaValor()))"></span>
            </div>
        </fieldset>
    </div>


    <!-- Lista de negociações adicionadas -->
    <template x-if="negociacoes.length > 0">
        <fieldset class="mt-4 border border-gray-300 rounded-md px-4 pb-2 bg-gray-50  ">

            {{-- <fieldset class="mt-4 border border-gray-300 rounded-md px-4 pb-2 bg-gray-50 max-h-64 overflow-y-auto">
                --}}

                <legend class="text-green-700 font-semibold text-sm px-2 leading-tight">Negociações Adicionadas:
                </legend>

                <table class="w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 sticky top-0 z-10">
                        <tr>
                            <th class="px-2 py-1 border text-center">Condição</th>
                            <th class="px-2 py-1 border text-center">Valor</th>
                            <th class="px-2 py-1 border text-center">Vencimento</th>
                            <th class="px-2 py-1 border text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(neg, index) in negociacoes" :key="index">
                            <tr :class="neg . fixo ? 'bg-blue-50' : ''">
                                <td class="px-2 py-1 border" x-text="neg.condicao_texto"></td>
                                <td class="px-2 py-1 border text-right" x-text="formatarValor(neg.valor)"></td>
                                <td class="px-2 py-1 border text-center" x-text="formatarData(neg.vencimento)"></td>
                                <td class="px-2 py-1 border text-center">
                                    <template x-if="!neg.fixo">
                                        <button @click="remover(index)"
                                            class="text-red-600 hover:underline">Remover</button>
                                    </template>
                                </td>
                            </tr>
                        </template>

                    </tbody>
                </table>
            </fieldset>
    </template>




    <!-- Campos ocultos para submissão -->
    <template x-for="(neg, index) in negociacoes" :key="'form-' + index">
        <div>
            <input type="hidden" :name="'negociacoes[' + index + '][id_cond_pagamento]'" :value="neg . condicao">
            <input type="hidden" :name="'negociacoes[' + index + '][valor]'" :value="neg . valor">
            <input type="hidden" :name="'negociacoes[' + index + '][data_vencimento]'" :value="neg . vencimento">
        </div>
    </template>
</div>
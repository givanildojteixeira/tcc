<div x-data="negociacao" class="space-y-4">
    <!-- Formulário de nova negociação -->
    <div class="grid md:grid-cols-3 gap-4 items-end">
        <!-- Condição de Pagamento -->
        <div>
            <label class="text-sm font-medium text-gray-700">Condição de Pagamento</label>
            <select x-model="nova.condicao" class="w-full border border-gray-300 rounded-md p-2">
                <option value="">Selecione...</option>
                @foreach ($condicoes as $cond)
                    <option value="{{ $cond->id }}">{{ $cond->descricao }}</option>
                @endforeach
            </select>
        </div>

        <!-- Valor -->
        <div>
            <label class="text-sm font-medium text-gray-700">Valor</label>
            <input type="number" x-model="nova.valor" step="0.01" min="0"
                class="w-full border border-gray-300 rounded-md p-2">
        </div>

        <!-- Vencimento -->
        <div>
            <label class="text-sm font-medium text-gray-700">Data de Vencimento</label>
            <input type="date" x-model="nova.vencimento"
                class="w-full border border-gray-300 rounded-md p-2">
        </div>
    </div>

    <button type="button" @click="adicionar"
        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
        Adicionar Condição
    </button>

    <!-- Lista de negociações adicionadas -->
    <template x-if="negociacoes.length > 0">
        <div class="mt-4 border border-gray-300 rounded-md p-4 bg-gray-50">
            <h3 class="text-green-700 font-semibold mb-2">Negociações Adicionadas:</h3>
            <table class="w-full text-sm text-left border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-2 py-1 border">Condição</th>
                        <th class="px-2 py-1 border">Valor</th>
                        <th class="px-2 py-1 border">Vencimento</th>
                        <th class="px-2 py-1 border">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(neg, index) in negociacoes" :key="index">
                        <tr>
                            <td class="px-2 py-1 border" x-text="neg.condicao_texto"></td>
                            <td class="px-2 py-1 border" x-text="formatarValor(neg.valor)"></td>
                            <td class="px-2 py-1 border" x-text="neg.vencimento"></td>
                            <td class="px-2 py-1 border">
                                <button @click="remover(index)" class="text-red-600 hover:underline">Remover</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </template>

    <!-- Campos ocultos para submissão -->
    <template x-for="(neg, index) in negociacoes" :key="'form-'+index">
        <div>
            <input type="hidden" :name="'negociacoes['+index+'][id_cond_pagamento]'" :value="neg.condicao">
            <input type="hidden" :name="'negociacoes['+index+'][valor]'" :value="neg.valor">
            <input type="hidden" :name="'negociacoes['+index+'][data_vencimento]'" :value="neg.vencimento">
        </div>
    </template>
</div>

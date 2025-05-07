<div x-data="observacao" x-init="carregaObservacao()" class="space-y-4">
    <!-- Observação Nota -->
    <div>
        <label for="observacao_nota" class="block text-sm font-medium text-gray-700 mb-1">
            Observação da Nota (visível ao cliente)
        </label>
        <textarea id="observacao_nota" rows="4"
            class="w-full border border-gray-300 rounded-md p-3 shadow-sm focus:ring-green-400 focus:outline-none"
            placeholder="Ex: Entrega programada para até 10 dias úteis, sujeito à análise financeira." x-model="nota"
            @blur="salvar()"></textarea>
    </div>

    <!-- Observação Interna -->
    <div>
        <label for="observacao_interna" class="block text-sm font-medium text-gray-700 mb-1">
            Observação Interna (uso administrativo)
        </label>
        <textarea id="observacao_interna" rows="4"
            class="w-full border border-gray-300 rounded-md p-3 shadow-sm focus:ring-green-400 focus:outline-none"
            placeholder="Ex: Cliente pediu reserva até sexta-feira, confirmação pendente da diretoria."
            x-model="interna" @blur="salvar()"></textarea>
    </div>

</div>
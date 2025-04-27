<div x-data class="space-y-6">

    <!-- Resumo Cliente e Veículo -->
    <div class="grid md:grid-cols-2 gap-6">
        <div class="border border-gray-300 bg-gray-50 p-4 rounded-md">
            <h3 class="text-lg font-semibold text-green-700 mb-2">Cliente</h3>
            <p class="text-sm text-gray-800"><strong>Nome:</strong> <span x-text="document.querySelector('[name=id_cliente]')?.closest('div').innerText || '---'"></span></p>
        </div>

        <div class="border border-gray-300 bg-gray-50 p-4 rounded-md">
            <h3 class="text-lg font-semibold text-green-700 mb-2">Veículo Novo</h3>
            <p class="text-sm text-gray-800"><strong>Chassi:</strong> <span x-text="document.querySelector('[name=id_veiculoNovo]')?.value || '---'"></span></p>
        </div>
    </div>

    <!-- Resumo Negociações -->
    <div class="border border-gray-300 bg-gray-50 p-4 rounded-md">
        <h3 class="text-lg font-semibold text-green-700 mb-2">Negociação</h3>
        <template x-if="document.querySelectorAll('[name^=negociacoes]').length > 0">
            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                <template x-for="el in Array.from(document.querySelectorAll('[name^=negociacoes]')).filter(e => e.name.includes('valor'))">
                    <li x-text="'Valor: R$ ' + parseFloat(el.value).toFixed(2).replace('.', ',')"></li>
                </template>
            </ul>
        </template>
        <template x-if="document.querySelectorAll('[name^=negociacoes]').length === 0">
            <p class="text-sm text-gray-500 italic">Nenhuma negociação adicionada.</p>
        </template>
    </div>

    <!-- Observações -->
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="text-sm font-medium text-gray-600">Observação da Nota</label>
            <div class="mt-1 p-3 border border-gray-200 rounded-md bg-white text-sm text-gray-700 min-h-[80px]">
                <span x-text="document.querySelector('[name=observacao_nota]')?.value || '---'"></span>
            </div>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-600">Observação Interna</label>
            <div class="mt-1 p-3 border border-gray-200 rounded-md bg-white text-sm text-gray-700 min-h-[80px]">
                <span x-text="document.querySelector('[name=observacao_interna]')?.value || '---'"></span>
            </div>
        </div>
    </div>

    <!-- Botão de envio -->
    <div class="text-right mt-6">
        <button type="submit"
            class="bg-blue-700 text-white px-6 py-2 rounded-md hover:bg-blue-800 text-sm font-medium">
            Enviar Proposta para Aprovação
        </button>
    </div>

    <form method="POST" action="{{ route('proposta.cancelar') }}" onsubmit="return confirm('Deseja realmente cancelar esta proposta? Esta ação apagará todos os dados!');">
        @csrf
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
            ❌ Cancelar Proposta
        </button>
    </form>
</div>

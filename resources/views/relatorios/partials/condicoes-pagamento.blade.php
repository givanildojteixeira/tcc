{{-- Cabeçalho --}}
<div class="flex justify-center font-semibold text-gray-600 border-b pb-1 max-w-2xl mx-auto">
    <div class="w-3/4">Descrição da Condição</div>
    <div class="w-1/4 text-center">Visível no Financeiro</div>
</div>

{{-- Listagem --}}
@forelse ($condicoes as $c)
    <div class="flex justify-center border-b py-1 text-sm text-gray-800 max-w-2xl mx-auto">
        <div class="w-3/4">{{ $c->descricao }}</div>
        <div class="w-1/4 text-center">
            {{ $c->financeira ? 'Sim' : 'Não' }}
        </div>
    </div>
@empty
    <p class="text-center text-gray-500 py-4">Nenhuma condição encontrada.</p>
@endforelse

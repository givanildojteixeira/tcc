<div class="space-y-2">
    <div class="grid grid-cols-4 font-semibold text-gray-600 border-b pb-1">
        <div>Nome</div>
        <div>CPF/CNPJ</div>
        <div>Email</div>
        <div>Telefone</div>
    </div>

    @forelse ($clientes as $c)
        <div class="grid grid-cols-4 border-b py-1 text-sm text-gray-800">
            <div>{{ $c->nome }}</div>
            <div>{{ formatarCpfCnpj($c->cpf_cnpj) }}</div>
            <div>{{ $c->email }}</div>
            <div>{{ $c->telefone }}</div>
        </div>
    @empty
        <p class="text-center text-gray-500 py-4">Nenhum cliente encontrado.</p>
    @endforelse
</div>

@php
    function formatarCpfCnpj($valor) {
        $valor = preg_replace('/\D/', '', $valor); // remove tudo que não for número
        if (strlen($valor) === 11) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $valor);
        } elseif (strlen($valor) === 14) {
            return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1.$2.$3/$4-$5", $valor);
        } else {
            return $valor;
        }
    }
@endphp
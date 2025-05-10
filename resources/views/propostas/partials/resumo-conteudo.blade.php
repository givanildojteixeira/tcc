<!-- resources/views/propostas/partials/resumo-conteudo.blade.php -->

<div id="area-impressao">
    <!-- Cabeçalho com logo e título -->
    <div class="flex items-center justify-between mb-6 border-b pb-4">
        <div class="flex items-center space-x-4">
            <img src="/images/guara.png" alt="Logo" class="w-20 h-12">
            <div>
                <h1 class="text-2xl font-bold">Resumo da Proposta de Venda</h1>
                <p class="text-sm text-gray-500">Gerado em {{ now()->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Cliente -->
    <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm">
        <legend class="text-gray-700 text-sm font-medium px-2">Cliente na proposta</legend>
        <ul class="text-sm text-gray-800">
            <li><strong>Nome:</strong> {{ $cliente->nome ?? '---' }}
                <strong class="ml-2">CPF/CNPJ:</strong> {{ $cliente->cpf_cnpj ?? '---' }}</li>
            <li><strong>Email:</strong> {{ $cliente->email ?? '---' }}
                <strong class="ml-2">Telefone:</strong> {{ $cliente->celular ?? '---' }}</li>
            <li><strong>CEP:</strong> {{ $cliente->cep ?? '---' }}
                <strong class="ml-2">Endereço:</strong> {{ $cliente->endereco ?? '---' }}
                <strong class="ml-2">Bairro:</strong> {{ $cliente->bairro ?? '---' }}
                <strong class="ml-2">Cidade:</strong> {{ $cliente->cidade ?? '---' }} / {{ $cliente->uf ?? '---' }}</li>
        </ul>
    </fieldset>

    <!-- Veículo Novo -->
    <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm">
        <legend class="text-gray-700 text-sm font-medium px-2">Veículo novo incluso na proposta</legend>
        <div class="grid grid-cols-3 text-sm text-gray-800">
            <div><strong>Marca:</strong> {{ $veiculo->marca }} - {{ $veiculo->desc_veiculo }} - {{ $veiculo->motor }}</div>
            <div><strong>Modelo:</strong> {{ $veiculo->modelo_fab }}</div>
            <div><strong>Opcional:</strong> {{ $veiculo->cod_opcional }}</div>
            <div><strong>Chassi:</strong> {{ $veiculo->chassi }}</div>
            <div><strong>Valor Tabela:</strong> R$ {{ number_format($veiculo->vlr_tabela, 2, ',', '.') }}</div>
            <div><strong>Combustível:</strong> {{ $veiculo->combustivel }}</div>
            <div><strong>Cor:</strong> {{ $veiculo->cor }}</div>
            <div><strong>Local:</strong> {{ $veiculo->local }}</div>
            <div><strong>Transmissão:</strong> {{ $veiculo->transmissao }}</div>
        </div>
    </fieldset>

    <!-- Veículo Usado -->
    @if ($veiculoUsado)
    <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm">
        <legend class="text-gray-700 text-sm font-medium px-2">Veículo Usado</legend>
        <div class="grid grid-cols-3 text-sm text-gray-800">
            <div><strong>Marca:</strong> {{ $veiculoUsado->marca }} - {{ $veiculoUsado->desc_veiculo }} - {{ $veiculoUsado->motor }}</div>
            <div><strong>Modelo:</strong> {{ $veiculoUsado->modelo_fab }}</div>
            <div><strong>Cor:</strong> {{ $veiculoUsado->cor }}</div>
            <div><strong>Chassi:</strong> {{ $veiculoUsado->chassi }}</div>
            <div><strong>Valor Avaliação:</strong> R$ {{ number_format($veiculoUsado->vlr_tabela, 2, ',', '.') }}</div>
            <div><strong>Combustível:</strong> {{ $veiculoUsado->combustivel }}</div>
            <div><strong>Ano:</strong> {{ $veiculoUsado->Ano_Mod }}</div>
            <div><strong>Placa:</strong> {{ $veiculoUsado->placa }}</div>
            <div><strong>KM:</strong> {{ $veiculoUsado->km }}</div>
        </div>
    </fieldset>
    @endif

    <!-- Negociações -->
    @if (!empty($negociacoes))
    <fieldset class="border border-gray-300 rounded-md px-4 pb-2 bg-gray-50 mt-4">
        <legend class="text-green-700 font-semibold text-sm px-2 leading-tight">Negociações Adicionadas:</legend>
        <table class="w-full text-sm text-left border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-2 py-1 border text-center">Condição</th>
                    <th class="px-2 py-1 border text-center">Valor</th>
                    <th class="px-2 py-1 border text-center">Vencimento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($negociacoes as $neg)
                <tr>
                    <td class="px-2 py-1 border">{{ $neg->condicao_texto }}</td>
                    <td class="px-2 py-1 border text-right">R$ {{ number_format($neg->valor, 2, ',', '.') }}</td>
                    <td class="px-2 py-1 border text-center">{{ \Carbon\Carbon::parse($neg->vencimento)->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-100">
                <tr>
                    <td class="px-2 py-1 border font-semibold text-right" colspan="1">Total:</td>
                    <td class="px-2 py-1 border font-bold text-right text-green-700" colspan="2">
                        R$ {{ number_format($negociacoes->sum('valor'), 2, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </fieldset>
    @endif

    <!-- Resumo Financeiro -->
    <fieldset class="border border-gray-300 rounded-md px-4 py-2 bg-gray-50 mt-4">
        <legend class="text-green-700 font-semibold text-sm px-2 leading-tight">Resumo Financeiro</legend>
        <div class="text-sm text-gray-800 space-y-1">
            <div class="flex justify-between"><span>Valor da Proposta:</span> <span>R$ {{ number_format($veiculo->vlr_tabela, 2, ',', '.') }}</span></div>
            <div class="flex justify-between"><span>Desconto:</span> <span>R$ {{ number_format($proposta->vlr_desconto ?? 0, 2, ',', '.') }}</span></div>
            <div class="flex justify-between"><span>Custo do Item:</span> <span>R$ {{ number_format($veiculo->vlr_nota ?? 0, 2, ',', '.') }}</span></div>
            <div class="flex justify-between"><span>Bônus:</span> <span>R$ {{ number_format($veiculo->vlr_bonus ?? 0, 2, ',', '.') }}</span></div>
            <div class="flex justify-between"><span>Usado(s):</span> <span>R$ {{ number_format($proposta->valor_veiculoUsado ?? 0, 2, ',', '.') }}</span></div>
            <div class="flex justify-between font-semibold text-green-700"><span>Lucro Estimado:</span>
                <span>R$ {{ number_format(($veiculo->vlr_tabela ?? 0) - ($proposta->vlr_desconto ?? 0) - ($veiculo->vlr_bonus ?? 0) - ($veiculo->vlr_nota ?? 0), 2, ',', '.') }}</span>
            </div>
        </div>
    </fieldset>

    <!-- Observações -->
    <div class="grid md:grid-cols-2 gap-6 mt-4">
        <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm">
            <legend class="text-gray-700 text-sm font-medium px-2">Observação da Nota</legend>
            <div class="p-2 bg-white border border-gray-200 rounded-md text-sm text-gray-700 min-h-[80px]">
                {{ $proposta->observacao_nota ?? '---' }}
            </div>
        </fieldset>

        <fieldset class="border border-green-400 bg-green-50 p-2 rounded-md shadow-sm">
            <legend class="text-gray-700 text-sm font-medium px-2">Observação Interna</legend>
            <div class="p-2 bg-white border border-gray-200 rounded-md text-sm text-gray-700 min-h-[80px]">
                {{ $proposta->observacao_interna ?? '---' }}
            </div>
        </fieldset>
    </div>
</div>

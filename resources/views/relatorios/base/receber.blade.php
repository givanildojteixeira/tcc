<x-relatorio-base 
    titulo="Relatório de Contas a Receber" 
    subTitulo="De {{ \Carbon\Carbon::parse($dataInicio)->format('d/m/Y') ?? '--' }} 
               até {{ \Carbon\Carbon::parse($dataFim)->format('d/m/Y') ?? '--' }}" 
    arquivoInclude="relatorios.partials.financeiro-receber"
    :dados="['negociacoes' => $negociacoes]"
/>
     
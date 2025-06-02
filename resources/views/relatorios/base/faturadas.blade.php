<x-relatorio-base 
    titulo="Relatório de Propostas Faturadas" 
    subTitulo="Propostas finalizadas com status 'Faturadas'"
    arquivoInclude="relatorios.partials.propostas"
    :dados="['propostas' => $propostas]"
/>
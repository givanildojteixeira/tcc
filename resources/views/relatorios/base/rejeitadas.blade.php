<x-relatorio-base 
    titulo="Relatório de Propostas Rejeitadas" 
    subTitulo="Propostas finalizadas com status 'Rejeitadas'"
    arquivoInclude="relatorios.partials.propostas"
    :dados="['propostas' => $propostas]"
/>
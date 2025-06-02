<x-relatorio-base 
    titulo="Relatório de Propostas Aprovadas" 
    subTitulo="Propostas finalizadas com status 'Aprovada'"
    arquivoInclude="relatorios.partials.propostas"
    :dados="['propostas' => $propostas]"
/>
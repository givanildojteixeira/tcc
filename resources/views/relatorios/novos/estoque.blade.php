<x-relatorio-base 
    titulo="Relatório de Estoque de Veículos Novos" 
    subTitulo="Listagem completa agrupada por modelo"
    arquivoInclude="relatorios.partials.estoque-novos"
    :dados="['veiculos' => $veiculos]"
/>

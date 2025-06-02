<x-relatorio-base 
    titulo="Relatório de Estoque de Veículos Usados" 
    subTitulo="Listagem completa agrupada por modelo"
    arquivoInclude="relatorios.partials.estoque-usados"
    :dados="['veiculos' => $veiculos]"
/>

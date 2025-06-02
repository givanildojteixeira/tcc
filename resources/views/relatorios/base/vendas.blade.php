<x-relatorio-base 
    titulo="Relatório de Vendas de Veículos Novos no Trimestre por Modelo" 
    subTitulo="Listagem vendas agrupada por modelo"
    arquivoInclude="relatorios.partials.vendas-novos"
    :dados="['veiculos' => $veiculos]"
/>

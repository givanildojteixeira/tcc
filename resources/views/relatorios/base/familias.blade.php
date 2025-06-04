<x-relatorio-base 
    titulo="Relatório de Famílias de Veículos" 
    subTitulo="Listagem das famílias cadastradas para agrupamento de modelos"
    arquivoInclude="relatorios.partials.familias"
    :dados="['familias' => $familias]"
/>

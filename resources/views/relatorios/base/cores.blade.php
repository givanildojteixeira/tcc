<x-relatorio-base 
    titulo="Relatório de Cores de Veículos" 
    subTitulo="Todas as cores cadastradas no sistema"
    arquivoInclude="relatorios.partials.cores"
    :dados="['cores' => $cores]"
/>

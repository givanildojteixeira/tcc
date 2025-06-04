<x-relatorio-base 
    titulo="Relatório de Condições de Pagamento" 
    subTitulo="Todas as condições cadastradas no sistema"
    arquivoInclude="relatorios.partials.condicoes-pagamento"
    :dados="['condicoes' => $condicoes]"
/>

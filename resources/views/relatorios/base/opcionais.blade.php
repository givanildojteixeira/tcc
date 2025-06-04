<x-relatorio-base 
    titulo="Relatório de Opcionais de Veículos" 
    subTitulo="Itens opcionais cadastrados por modelo ou chassi"
    arquivoInclude="relatorios.partials.opcionais"
    :dados="['opcionais' => $opcionais]"
/>

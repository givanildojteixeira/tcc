<x-relatorio-base 
    titulo="Relatório de Clientes" 
    arquivoInclude="relatorios.partials.clientes"
    :dados="['clientes' => $clientes]"
/>

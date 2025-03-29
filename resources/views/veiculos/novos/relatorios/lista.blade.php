<x-app-layout >
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div id="area-impressao" class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-end space-x-2 mb-4 print:hidden">
                        <!-- Botão Voltar -->
                        <a href="{{ route('veiculos.novos.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded text-sm">
                            ⬅ Voltar
                        </a>

                        <!-- Botão Imprimir -->
                        <button onclick="window.print()"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                            🖨️ Imprimir
                        </button>
                    </div>



                    {{-- Cabeçalho com logo e título --}}
                    <div class="flex items-center justify-between mb-6 border-b pb-4">
                        <div class="flex items-center space-x-4">
                            <img src="/images/guara.png" alt="Logo" class="w-20 h-12">
                            <div>
                                <h1 class="text-2xl font-bold">Relatório de Veículos</h1>
                                <p class="text-sm text-gray-500">Gerado em {{ now()->format('d/m/Y H:i') }}</p>

                                {{-- Filtros aplicados --}}
                                <p class="text-xs text-gray-600 mt-1">
                                    Filtrar:
                                    @php
                                        $filtros = [
                                            'Família' => session('familia_selecionado'),
                                            'Modelo' => session('modelo_selecionado'),
                                            'Chassi' => session('chassi_selecionado'),
                                            'Combustível' => session('combustivel_selecionado'),
                                            'Ano' => session('ano_selecionado'),
                                            'Transmissão' => session('transmissao_selecionado'),
                                            'Cor' => session('cor_selecionado'),
                                        ];
                                        $filtrosAtivos = array_filter($filtros);
                                    @endphp

                                    @if (count($filtrosAtivos))
                                        {{ collect($filtrosAtivos)->map(fn($v, $k) => "$k: $v")->implode(', ') }}
                                    @else
                                        todos
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>


                    {{-- Lista de veículos --}}
                    @forelse($veiculos as $veiculo)
                        <div class="py-4 border-b border-dashed">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-sm">
                                <div><strong>Modelo:</strong> {{ $veiculo->desc_veiculo }}</div>
                                <div><strong>Chassi:</strong> {{ $veiculo->chassi }}</div>
                                <div><strong>Cor:</strong> {{ $veiculo->cor }}</div>
                                <div><strong>Ano:</strong> {{ $veiculo->Ano_Mod }}</div>
                                <div><strong>Combustível:</strong> {{ $veiculo->combustivel }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Nenhum veículo encontrado com os filtros aplicados.</p>
                    @endforelse
                </div>
                @push('scripts')
                    <script>
                        window.addEventListener('load', () => window.print());
                    </script>
                @endpush

            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function imprimirDiv() {
        const conteudo = document.getElementById('area-impressao').innerHTML;

        const janela = window.open('', '', 'height=800,width=1000');
        janela.document.write('<html><head><title>Relatório</title>');

        // Se quiser manter o estilo Tailwind/Darkmode ou o seu CSS customizado:
        document.querySelectorAll('link[rel="stylesheet"]').forEach(link => {
            janela.document.write(link.outerHTML);
        });

        janela.document.write('</head><body>');
        janela.document.write(conteudo);
        janela.document.write('</body></html>');

        janela.document.close();
        janela.focus();
        janela.print();
        janela.close();
    }
</script>

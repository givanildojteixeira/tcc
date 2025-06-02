@props(['titulo', 'subTitulo' => '', 'arquivoInclude', 'dados' => []])

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div id="area-impressao" class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Botões superiores --}}
                    <div class="flex justify-end space-x-2 mb-4 print:hidden">
                        <a href="{{ url()->previous() }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded text-sm">
                            ⬅ Voltar
                        </a>

                        <button onclick="window.print()"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                            🖨️ Imprimir
                        </button>
                    </div>

                    {{-- Cabeçalho do relatório --}}
                    <div class="flex items-center justify-between mb-6 border-b pb-4">
                        <div class="flex items-center space-x-4">
                            <img src="/images/guara.png" alt="Logo" class="w-20 h-12">
                            <div>
                                <h1 class="text-2xl font-bold">{{ $titulo }}</h1>
                                @if ($subTitulo)
                                    <h2 class="text-lg font-semibold text-gray-600">{{ $subTitulo }}</h2>
                                @endif
                                <p class="text-sm text-gray-500">Gerado em {{ now()->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Conteúdo dinâmico do relatório --}}
                    @include($arquivoInclude, $dados)
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

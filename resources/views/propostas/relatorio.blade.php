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

                    {{-- Conteúdo da proposta --}}
                    @include('propostas.partials.resumo-conteudo')


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



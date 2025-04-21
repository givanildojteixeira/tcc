@props(['familia'])

<div>
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl w-full relative">
        <h2 class="text-xl font-bold text-gray-700 mb-4">
            Documentos para a família: <span x-text="familia"></span>
        </h2>

        {{-- Parte dinâmica do PHP: mostrar arquivos da pasta --}}
        @php
            $pasta = public_path('upload/familia');
            // Por fallback, define uma string vazia para evitar erro caso 'familia' não esteja vindo por Blade
            $familiaStatic = $attributes->get('data-familia', '');
            $nomeFamilia = \Illuminate\Support\Str::slug($familiaStatic, '-');

            $arquivos = collect(\File::files($pasta))
                ->filter(fn($file) => str_starts_with($file->getFilename(), $nomeFamilia . '-'));
        @endphp

        @if ($arquivos->isEmpty())
            <p class="text-gray-500 italic">Nenhum documento encontrado para esta família.</p>
        @else
            <ul class="space-y-2">
                @foreach ($arquivos as $arquivo)
                    @php
                        $nomeArquivo = $arquivo->getFilename();
                        $visivel = \Illuminate\Support\Str::after($nomeArquivo, $nomeFamilia . '-');
                    @endphp
                    <li class="flex justify-between items-center">
                        <a href="{{ asset('upload/familia/' . $nomeArquivo) }}" target="_blank"
                           class="text-blue-600 hover:underline">
                            <i class="fas fa-file mr-1"></i> {{ $visivel }}
                        </a>
                        <form method="POST" action="{{ route('familia.excluirArquivoSimples') }}">
                            @csrf
                            <input type="hidden" name="arquivo_excluir" value="{{ $nomeArquivo }}">
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                <i class="fas fa-trash-alt"></i> Excluir
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Botão de fechar -->
        <button @click="$dispatch('fechar-modal')"
                class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>
    </div>
</div>

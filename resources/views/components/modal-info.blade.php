@props(['titulo' => 'Atenção', 'mensagem' => '', 'icone' => 'fas fa-info-circle', 'cor' => 'blue'])

<div x-data="{ show: false }" x-cloak @keydown.escape.window="show = false">
    <!-- Botão que dispara o modal -->
    {{ $trigger ?? '' }}

    <!-- Modal Informativo -->
    <div x-show="show"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
        style="display: none;"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <div class="bg-white p-6 rounded-lg shadow-xl w-1/3 animate-shake border-t-4 border-{{ $cor }}-500 relative">
            <!-- Ícone -->
            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white p-2 rounded-full shadow">
                <i class="{{ $icone }} text-{{ $cor }}-500 text-4xl"></i>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-6 text-center">{{ $titulo }}</h2>
            <p class="text-sm text-gray-600 text-center my-4">
                {!! nl2br(e($mensagem)) !!}
            </p>

            <div class="flex justify-center">
                <button @click="show = false"
                    class="px-4 py-2 bg-{{ $cor }}-500 text-white rounded hover:bg-{{ $cor }}-700 text-sm">
                    Entendi
                </button>
            </div>
        </div>
    </div>
</div>

@props(['id', 'action', 'registro' => ''])

{{--  modelo de aplicação
<x-modal-excluir 
    :id="$cor->id" 
    :action="route('cores.destroy',$cor->id)" 
    :registro="'Modelo: ' . $cor->cor_desc">
    <x-slot:trigger>
        <button @click="show = true"
            class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm">
            Excluir
        </button>
    </x-slot:trigger>
</x-modal-excluir> 
--}}


<div x-data="{ show: false }" x-cloak @keydown.escape.window="show = false">
    <!-- Botão que dispara o modal -->
    {{ $trigger ?? '' }}

    <!-- Modal -->
    <form method="POST" :action="show ? '{{ $action }}' : '#'" x-show="show"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" style="display: none;"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <!-- Modal -->
        <div class="bg-white p-6 rounded-lg shadow-xl w-1/3 animate-shake border-t-4 border-red-500 relative">
            <!-- Ícone de atenção -->
            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white p-2 rounded-full shadow">
                <i class="fas fa-exclamation-triangle text-red-500 text-4xl"></i>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-6 text-center">Confirmação de Exclusão</h2>
            <p class="text-sm text-gray-600 text-center mb-6">
                Tem certeza de que deseja excluir este registro?<br>
                <span class="font-semibold text-gray-800">{{ $registro }}</span><br>
                <span class="text-red-600 font-medium">Essa ação não poderá ser desfeita.</span>
            </p>

            <div class="flex justify-center gap-4">
                <form method="POST" action="{{ $action }}" class="flex justify-center gap-4">
                    @csrf
                    @method('DELETE')

                    <button type="button" @click="show = false"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-sm">Cancelar</button>

                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">Sim,
                        excluir</button>
                </form>

            </div>
        </div>
    </form>
</div>
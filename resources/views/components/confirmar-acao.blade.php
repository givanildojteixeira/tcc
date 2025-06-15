<div 
    x-data="{ show: false, confirmar: () => {}, cancelar: () => {}, titulo: '', mensagem: '' }"
    x-show="show"
    @open-confirmacao.window="event => {
        titulo = event.detail.titulo;
        mensagem = event.detail.mensagem;
        confirmar = event.detail.onConfirm;
        cancelar = event.detail.onCancel ?? (() => { show = false });
        show = true;
    }"
    class="fixed inset-0 bg-black bg-opacity-50 z-[10001] flex items-center justify-center"
    style="display: none;"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md border-t-4 border-green-500 animate-shake relative">
        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white p-2 rounded-full shadow">
            <i class="fas fa-question-circle text-green-500 text-4xl"></i>
        </div>

        <h2 class="text-lg font-semibold text-gray-800 mt-6 text-center" x-text="titulo"></h2>

        <p class="text-sm text-gray-600 text-center mb-6" x-text="mensagem"></p>

        <div class="flex justify-center gap-4">
            <button @click="show = false; cancelar()"
                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-sm">
                Cancelar
            </button>
            <button @click="show = false; confirmar()"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                Confirmar
            </button>
        </div>
    </div>
</div>

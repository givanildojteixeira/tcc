<!--  Modal de Nova Cor  -->
<div x-show="showModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
    style="display: none;">
    <div @click.away="showModal = false" class="bg-white p-6 rounded-lg w-full max-w-2xl md:w-1/2 shadow-lg">
        <form action="{{ route('cores.store') }}" method="POST" class="space-y-4">
            @csrf
            <h3 class="text-lg font-semibold text-gray-800">Nova Cor</h3>

            <input type="text" name="cor_desc" placeholder="Descrição da Cor"
                class="w-full border px-4 py-2 rounded focus:ring-2 focus:ring-green-500" required>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showModal = false"
                    class="flex items-center gap-2 text-gray-700 border border-gray-300 hover:bg-gray-100 px-4 py-2 rounded-md transition">
                    <i class="fa-solid fa-xmark"></i> <span>Cancelar</span>
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    💾 Salvar
                </button>
            </div>
        </form>
    </div>
</div>
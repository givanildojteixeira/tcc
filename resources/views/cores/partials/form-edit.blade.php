<!-- Modal de Edição -->
<div x-show="editModal" x-cloak x-transition.opacity
    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div @click.away="editModal = false" class="bg-white p-6 rounded-lg w-full max-w-2xl md:w-1/2 shadow-lg">
        <form :action="'/cores/' + editData.id" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-semibold text-gray-800">Editar Cor</h3>

            <input type="text" name="cor_desc" x-model="editData.cor_desc"
                class="w-full border px-4 py-2 rounded focus:ring-2 focus:ring-green-500" required>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="editModal = false"
                    class="flex items-center gap-2 text-gray-700 border border-gray-300 hover:bg-gray-100 px-4 py-2 rounded-md transition">
                    <i class="fa-solid fa-xmark"></i> <span>Cancelar</span>
                </button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    💾 Atualizar
                </button>
            </div>
        </form>
    </div>
</div>
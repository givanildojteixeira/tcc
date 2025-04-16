<h3 class="text-2xl font-semibold text-green-700">Cadastrar Novo Opcional</h3>

<form action="{{ route('opcionais.store') }}" method="POST" class="space-y-4">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Modelo/Fab</label>
            <input type="text" name="modelo_fab"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Código do Opcional</label>
            <input type="text" name="cod_opcional"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>
    </div>

    <div>
        <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
        <textarea name="descricao" id="descricao" rows="4" maxlength="5000"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            required></textarea>
    </div>

    <div class="flex justify-end gap-3 mt-6">
        <button type="submit"
            class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition">
            <i class="fa-solid fa-floppy-disk"></i> <span>Salvar</span>
        </button>

        <button type="button" @click="showModal = false"
            class="flex items-center gap-2 text-gray-700 border border-gray-300 hover:bg-gray-100 px-4 py-2 rounded-md transition">
            <i class="fa-solid fa-xmark"></i> <span>Cancelar</span>
        </button>
    </div>
</form>

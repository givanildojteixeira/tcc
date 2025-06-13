<!--  Cabeçalho -->
<div class="mb-6 space-y-1">
    <h3 class="text-2xl font-semibold text-blue-700">Editar Nível de Acesso</h3>
    <p>Nome do usuário: <strong x-text="editUser.name"></strong></p>
    <p>Nível atual: <strong x-text="editUser.level"></strong></p>
</div>

<!--  Formulário de nível + botão Salvar -->
<form :action="`{{ url('/user-edit') }}/${editUser.id}`" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div class="flex flex-wrap md:flex-nowrap items-end gap-3">
        <!-- Select -->
        <div class="flex-1">
            <select name="level" required class="py-2 px-4 rounded w-full border border-gray-300 focus:ring-2 focus:ring-blue-500">
                <option value="" disabled>Selecione uma opção</option>
                <option value="Vendedor" :selected="editUser.level === 'Vendedor'">🛒 Vendedor</option>
                <option value="Assistente" :selected="editUser.level === 'Assistente'">✍️ Assistente</option>
                <option value="Gerente" :selected="editUser.level === 'Gerente'">👔 Gerente</option>
                <option value="Diretor" :selected="editUser.level === 'Diretor'">📂 Diretor</option>
                <option value="admin" :selected="editUser.level === 'admin'">🛡️ Administrador</option>
            </select>
            
        </div>

        <!-- Botão Salvar -->
        <div>
            <button type="submit"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition whitespace-nowrap">
                <i class="fa-solid fa-floppy-disk"></i> Salvar
            </button>
        </div>
    </div>
</form>

<!--  Ações adicionais: Ativar/Desativar, Remover e Cancelar -->
<div class="flex flex-wrap justify-center items-center gap-3 mt-6">

    <!--  Botão Ativar/Desativar -->
    <form :action="`{{ url('/user-ativo') }}/${editUser.id}/${editUser.active ? 0 : 1}`" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit"
            :class="editUser.active 
                ? 'flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition' 
                : 'flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition'">
            <i :class="editUser.active ? 'fa-solid fa-ban' : 'fa-solid fa-check'"></i>
            <span x-text="editUser.active ? 'Desativar' : 'Ativar'"></span>
        </button>
    </form>
    

    <!--  Botão Remover -->
    <form :action="`{{ url('/user') }}/${editUser.id}`" method="POST"
        onsubmit="return confirm('Tem certeza que deseja remover este usuário?');">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition">
            <i class="fa-solid fa-trash"></i>
            Remover
        </button>
    </form>

    <!--  Botão Cancelar -->
    <button type="button" @click="editModal = false"
        class="flex items-center gap-2 text-gray-700 border border-gray-300 hover:bg-gray-100 px-4 py-2 rounded-md transition">
        <i class="fa-solid fa-xmark"></i> Cancelar
    </button>


</div>
<div class="bg-white p-6 rounded-lg w-full max-w-3xl max-h-[90vh] overflow-y-auto shadow-lg items-start">

    <form method="POST" :action="`/clientes/${editData.id}`">
        @csrf
        @method('PUT')

        <!-- Abas estilizadas -->
        <div x-data="{ tabAtiva: 'dados' }">
            <div class="flex bg-gray-100 rounded-md overflow-hidden shadow-sm mb-6 font-bold text-sm">
                <button type="button" @click="tabAtiva = 'dados'"
                    :class="tabAtiva === 'dados' ? 'bg-blue-100 text-blue-700 shadow-inner' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                    class="flex-1 px-4 py-2 transition-all duration-200">
                    <i class="fas fa-user"></i> Dados Pessoais / Empresa
                </button>
                <button type="button" @click="tabAtiva = 'endereco'"
                    :class="tabAtiva === 'endereco' ? 'bg-blue-100 text-blue-700 shadow-inner' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                    class="flex-1 px-4 py-2 transition-all duration-200">
                    <i class="fas fa-map-marker-alt"></i> Endereço e Contato
                </button>
                <button type="button" @click="tabAtiva = 'observacoes'"
                    :class="tabAtiva === 'observacoes' ? 'bg-blue-100 text-blue-700 shadow-inner' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                    class="flex-1 px-4 py-2 transition-all duration-200">
                    <i class="fas fa-sticky-note"></i> Observações
                </button>
            </div>

            <!-- Aba Dados -->
            <div x-show="tabAtiva === 'dados'" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <x-input label="Nome" name="nome" required x-model="editData.nome" />
                    <x-input label="Email" name="email" type="email" required x-model="editData.email" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <x-input label="Celular" name="celular" x-model="editData.celular" />
                    <x-input label="Telefone Residencial" name="telefone" x-model="editData.telefone" />
                    <x-input label="Telefone Comercial" name="telefone_comercial"
                        x-model="editData.telefone_comercial" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <x-select label="Tipo Pessoa" name="tipo_pessoa" required x-model="editData.tipo_Pessoa">
                        <option value="" disabled>Selecione</option>
                        <option value="Física">Física</option>
                        <option value="Jurídica">Jurídica</option>
                    </x-select>
                    <x-input label="CPF/CNPJ" name="cpf_cnpj" required x-model="editData.cpf_cnpj" />
                </div>

                <div x-show="editData.tipo_Pessoa === 'Física'" class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <x-select label="Sexo" name="sexo" x-model="editData.sexo" required>
                        <option value="">Não Informado</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="Outro">Outro</option>
                    </x-select>
                    <x-select label="Estado Civil" name="estado_civil" x-model="editData.estado_civil" required>
                        <option value="">--</option>
                        <option value="Solteiro(a)">Solteiro</option>
                        <option value="Casado(a)">Casado</option>
                        <option value="Divorciado(a)">Divorciado</option>
                        <option value="Viúvo(a)">Viúvo</option>
                        <option value="União Estável">União Estável</option>
                    </x-select>
                    <x-input label="Data de Nascimento" name="data_nascimento" type="date" required
                        x-model="editData.data_nascimento" />
                </div>

                <div x-show="editData.tipo_Pessoa === 'Jurídica'" class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <x-input label="Nome Fantasia" name="nome_fantasia" x-model="editData.nome_fantasia" />
                    <x-input label="Data de Fundação" name="data_fundacao" type="date"
                        x-model="editData.data_fundacao" />
                    <x-input label="Inscrição Estadual" name="inscricao_estadual"
                        x-model="editData.inscricao_estadual" />
                    <x-input label="Inscrição Municipal" name="inscricao_municipal"
                        x-model="editData.inscricao_municipal" />
                </div>
            </div>

            <!-- Aba Endereço -->
            <div x-show="tabAtiva === 'endereco'" class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <x-input label="CEP" name="cep" x-model="editData.cep" />
                <x-input label="Endereço" name="endereco" x-model="editData.endereco" />
                <x-input label="Número" name="numero" x-model="editData.numero" />
                <x-input label="Complemento" name="complemento" x-model="editData.complemento" />
                <x-input label="Bairro" name="bairro" x-model="editData.bairro" />
                <x-input label="Cidade" name="cidade" x-model="editData.cidade" />
                <x-input label="UF" name="uf" maxlength="2" x-model="editData.uf" />
                <div class="flex items-center space-x-2 mt-2">
                    <input type="checkbox" name="ativo" value="1" x-bind:checked="editData.ativo == 1"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring focus:ring-green-500">
                    <label for="ativo" class="text-sm text-gray-700">Cliente Ativo</label>
                </div>
            </div>

            <!-- Aba Observações -->
            <div x-show="tabAtiva === 'observacoes'" class="grid grid-cols-1 gap-2">
                <x-textarea label="Observações" name="observacoes" rows="6" x-model="editData.observacoes" />
            </div>

            <!-- Botões -->
            <div class="flex justify-end mt-6 space-x-3">
                <button type="button" @click="editModal = false"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-gray-800">
                    ❌ Cancelar
                </button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    💾 Atualizar
                </button>
            </div>
        </div>
    </form>
</div>
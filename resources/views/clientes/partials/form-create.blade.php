<form method="POST" action="{{ route('clientes.store') }}">
    @csrf

    <div x-data="{ aba: 'dados' }">
        <!-- Abas -->
        <div class="flex border-b mb-4 text-sm font-medium text-gray-600">
            <button type="button" @click="aba = 'dados'"
                :class="aba === 'dados' ? 'border-b-2 border-green-600 text-green-600' : ''" class="mr-4 pb-2">🧍
                Dados</button>

            <button type="button" @click="aba = 'endereco'"
                :class="aba === 'endereco' ? 'border-b-2 border-green-600 text-green-600' : ''" class="pb-2">📍 Endereço
                & Contato</button>
        </div>

        <!-- Aba Dados -->
        <div x-show="aba === 'dados'" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-input label="Nome" name="nome" required />
            <x-select label="Tipo Pessoa" name="tipo_pessoa" required>
                <option value="">Selecione</option>
                <option value="Física">Física</option>
                <option value="Jurídica">Jurídica</option>
            </x-select>
            <x-input label="CPF/CNPJ" name="cpf_cnpj" required />
            <x-input label="Email" name="email" type="email" />
            <x-input label="Celular" name="celular" />
            <x-input label="Telefone Residencial" name="telefone" />
            <x-input label="Telefone Comercial" name="telefone_comercial" />

            <x-select label="Sexo" name="sexo">
                <option value="">Não Informado</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
                <option value="Outro">Outro</option>
            </x-select>

            <x-select label="Estado Civil" name="estado_civil">
                <option value="">--</option>
                <option value="Solteiro(a)">Solteiro(a)</option>
                <option value="Casado(a)">Casado(a)</option>
                <option value="Divorciado(a)">Divorciado(a)</option>
                <option value="Viúvo(a)">Viúvo(a)</option>
                <option value="União Estável">União Estável</option>
            </x-select>

            <x-input label="Data de Nascimento" name="data_nascimento" type="date" />
            <x-input label="Data de Fundação" name="data_fundacao" type="date" />
            <x-input label="Nome Fantasia" name="nome_fantasia" />
            <x-input label="Inscrição Estadual" name="inscricao_estadual" />
            <x-input label="Inscrição Municipal" name="inscricao_municipal" />

            <x-textarea label="Observações" name="observacoes" class="col-span-full" />
        </div>

        <!-- Aba Endereço -->
        <div x-show="aba === 'endereco'" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-input label="CEP" name="cep" />
            <x-input label="Endereço" name="endereco" />
            <x-input label="Número" name="numero" />
            <x-input label="Complemento" name="complemento" />
            <x-input label="Bairro" name="bairro" />
            <x-input label="Cidade" name="cidade" />
            <x-input label="UF" name="uf" maxlength="2" />

            <div class="flex items-center space-x-2 mt-2">
                <input type="checkbox" name="ativo" value="1" checked
                    class="rounded border-gray-300 text-green-600 shadow-sm focus:ring focus:ring-green-500">
                <label for="ativo" class="text-sm text-gray-700">Cliente Ativo</label>
            </div>
        </div>

        <!-- Botões -->
        <div class="flex justify-end mt-6 space-x-3">
            <button type="button" @click="$el.closest('[x-data]').__x.$data.showModal = false"
                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-gray-800">
                ❌ Cancelar
            </button>

            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                💾 Salvar
            </button>
        </div>
    </div>
</form>
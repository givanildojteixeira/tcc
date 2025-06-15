<div x-data="{ tabAtiva: 'dados', tipoPessoa: '' }"
    class="bg-white p-1 rounded-lg w-full max-w-3xl max-h-[90vh] overflow-y-auto shadow-lg items-start">

    <form method="POST" action="{{ route('clientes.store') }}">
        @csrf

        {{-- analise a origem para voltar no mesmo lugar que foi chamado --}}
        @if (isset($origem) && $origem === 'proposta')
            <input type="hidden" name="from_proposta" value="1">
        @endif

        <!-- Abas -->
        <div class="flex bg-gray-100 rounded-md overflow-hidden shadow-sm font-bold text-sm mb-4">
            <button type="button" @click="tabAtiva = 'dados'"
                :class="tabAtiva === 'dados' ? 'bg-blue-100 text-blue-700 shadow-inner' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 transition-all duration-200">
                <i class="fas fa-user"></i> Dados Pessoais / Empresa
            </button>
            <button type="button" @click="tabAtiva = 'fisjus'"
                :class="tabAtiva === 'fisjus' ? 'bg-blue-100 text-blue-700 shadow-inner' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-800'"
                class="flex-1 px-4 py-2 transition-all duration-200">
                <i class="fas fa-user"></i> Tipo de Pessoa
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

        <!-- Conteúdo -->
        <!-- Container fixo para abas -->
        <div class=" flex flex-col justify-between">
            <!-- Aba Dados -->
            <div x-show="tabAtiva === 'dados'">
                <!-- Parte superior com 2 colunas -->
                <div class="grid grid-cols-1 gap-2 h-full">
                    <x-input label="Nome" name="nome" required />
                </div>
                <div class="grid grid-cols-1 gap-2 h-full">
                    <x-input label="Email" name="email" type="email" required />
                </div>
                <!-- Bloco isolado com 3 colunas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <x-input label="Celular" name="celular" mask="celular" />
                    <x-input label="Telefone Residencial" name="telefone" mask="telefone" />
                    <x-input label="Telefone Comercial" name="telefone_comercial" mask="telefone" />
                </div>
            </div>
        </div>
        <div class=" flex flex-col justify-between">
            <!-- Tipo de Pessoa -->
            <div x-show="tabAtiva === 'fisjus'">
                <x-select label="Tipo Pessoa" name="tipo_pessoa" required x-model="tipoPessoa">
                    <option value="" disabled selected>Selecione</option>
                    <option value="Física">Física</option>
                    <option value="Jurídica">Jurídica</option>
                </x-select>
                {{-- tipo de Pessoa --}}
                <input type="hidden" name="tipo_pessoa" :value="tipoPessoa">
                <div x-show="tipoPessoa === 'Física'" class="contents grid grid-cols-4 gap-2">
                    <x-input label="CPF" name="cpf" id="cpfCnpjInput" mask="cpf" />

                    <div class="grid grid-cols-3 gap-2 h-full">
                        <x-select label="Sexo" name="sexo">
                            <option value="">Não Informado</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="Outro">Outro</option>
                        </x-select>
                        <x-select label="Estado Civil" name="estado_civil">
                            <option value="">--</option>
                            <option value="Solteiro(a)">Solteiro</option>
                            <option value="Casado(a)">Casado</option>
                            <option value="Divorciado(a)">Divorciado</option>
                            <option value="Viúvo(a)">Viúvo</option>
                            <option value="União Estável">União Estável</option>
                        </x-select>
                        <x-input label="Data de Nascimento" name="data_nascimento" type="date" />
                    </div>
                </div>
                <div x-show="tipoPessoa === 'Jurídica'" class="contents">
                    <div class="grid grid-cols-2 gap-2 h-full">
                        <x-input label="CNPJ" name="cnpj" id="cpfCnpjInput" mask="cnpj" />
                        <x-input label="Nome Fantasia" name="nome_fantasia" />
                    </div>
                    <div class="grid grid-cols-3 gap-2 h-full">
                        <x-input label="Data de Fundação" name="data_fundacao" type="date" />
                        <x-input label="Inscrição Estadual" name="inscricao_estadual" />
                        <x-input label="Inscrição Municipal" name="inscricao_municipal" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Aba Endereço -->
        <div x-show="tabAtiva === 'endereco'" class="grid grid-cols-1 md:grid-cols-2 gap-2 h-full">
            <x-input label="CEP" name="cep" />
            <x-input label="Endereço" name="endereco" />
            <x-input label="Número" name="numero" />
            <x-input label="Complemento" name="complemento" />
            <x-input label="Bairro" name="bairro" />
            <x-input label="Cidade" name="cidade" />
            <x-input label="UF" name="uf" maxlength="2" />
            <div class="flex items-center space-x-2 mt-2">
                <input type="checkbox" name="ativo" value="1" x-bind:checked="editData.ativo == 1"
                    class="rounded border-gray-300 text-green-600 shadow-sm focus:ring focus:ring-green-500">
                <label for="ativo" class="text-sm text-gray-700">Cliente Ativo</label>
            </div>
        </div>

        <!-- Aba Observações -->
        <div x-show="tabAtiva === 'observacoes'" class="grid grid-cols-1 gap-2 h-full">
            <x-textarea label="Observações" name="observacoes" rows="6" />
        </div>

        <!-- Botões -->
        <div class="flex justify-end mt-6 space-x-3">
            <button type="button" @click="showModalCliente = false"
                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-gray-800">
                ❌ Cancelar
            </button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                ✅ Cadastrar
            </button>
        </div>
    </form>
</div>
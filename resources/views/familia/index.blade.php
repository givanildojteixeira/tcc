<x-app-layout>    {{--  ✅  Gerenciar famílias de veículos - INDEX - FAMILIA --}}
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <!-- Título e Feedback -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-green-700">Gerenciar famílias de veículos</h2>
            <x-bt-ajuda/> <!-- Botão de Ajuda -->
        </div>

        <!-- Formulário -->
        <form id="formFamilia" action="{{ route('familia.store') }}" method="POST" enctype="multipart/form-data"
            class="border border-gray-300 rounded-lg shadow-lg p-6 mb-8 ">

            @csrf

            <div class="flex flex-wrap gap-4 mb-4">
                <!-- Nome da Família -->
                <div class="flex-grow basis-[10%] min-w-[100px]">
                    <label class="block text-gray-700 font-medium mb-1">Nome da Família</label>
                    <input type="text" name="descricao" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
                </div>
                <!-- Site -->
                <div class="basis-[70%] flex-grow min-w-[180px]">
                    <label class="block text-gray-700 font-medium mb-1">Site de Apoio</label>
                    <input type="text" name="site"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

            </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <!-- Imagem da Família -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Imagem da Família</label>
                        <input type="file" name="imagem" accept=".jpg,.jpeg"
                            class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-green-100 file:text-green-700
                                   hover:file:bg-green-200">
                    </div>

                    <!-- Arquivo MEV -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Arquivo MEV</label>
                        <input type="file" name="arquivo_mev" accept=".pdf"
                            class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-green-100 file:text-green-700
                                   hover:file:bg-green-200">
                    </div>

                    <!-- Documento Adicional -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Documentos</label>
                        <input type="file" name="documentos" accept="*"
                            class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-green-100 file:text-green-700
                                   hover:file:bg-green-200">
                    </div>
                </div>


            <div class="flex flex-wrap items-center gap-4 ">
                @if(request('from') && request('origem'))
                <div class="mb-4">
                    <a href="{{ url('/veiculos/' . request('from') . '/edit?from=' . request('origem')) }}"
                        class="inline-flex items-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-md shadow-sm transition">
                        <i class="fas fa-arrow-left"></i>
                        Voltar para edição do veículo
                    </a>
                </div>
            @endif


                <button type="submit"
                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md shadow-md">
                    <i class="fas fa-plus-circle"></i>
                    Cadastrar ou Alterar Família
                </button>

                <x-checkbox-config
                chave="mostrar_todas_familias"
                label="Mostrar todas as famílias no carrossel (mesmo sem veículos)" />





            </div>


        </form>
        <!-- Lista de Famílias -->
        <div class="max-w-4xl mx-auto overflow-x-auto">
            <table class="min-w-full border text-sm text-left">
                <thead class="bg-green-50 text-green-800 uppercase">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Descrição</th>
                        <th class="px-4 py-2 border">Imagem</th>
                        <th class="px-4 py-2 border text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($familias as $familia)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $familia->id }}</td>
                            <td class="px-4 py-2 border">{{ $familia->descricao }}</td>
                            <td class="px-4 py-2 border">
                                @php
                                    $nomeArquivo = str_replace(' ', '_', $familia->descricao) . '.jpg';
                                @endphp
                                @if (file_exists(public_path('images/familia/' . $nomeArquivo)))
                                    <img src="{{ asset('images/familia/' . $nomeArquivo) }}" alt="Imagem"
                                        class="h-12 rounded">
                                @else
                                    <span class="text-gray-400 italic">Sem imagem</span>
                                @endif

                            </td>
                            <td class="px-4 py-2 border text-center">
                                <!-- Form de exclusão -->
                                <form action="{{ route('familia.destroy', $familia->id) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir esta família?')"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 mr-3" title="Excluir">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                                <!-- Botão Editar (abre modal ou navega) -->
                                <button
                                    onclick="preencherFormulario('{{ $familia->id }}', '{{ $familia->descricao }}', '{{ $familia->site }}')"
                                    class="text-blue-600 hover:text-blue-800" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                    @if ($familias->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-4">Nenhuma família cadastrada.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Ajuda -->
    <div id="modalAjuda" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full p-6 relative flex gap-6">

            <!-- Ícone de Informação à esquerda -->
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 text-6xl"></i>
            </div>

            <!-- Conteúdo do Modal -->
            <div class="flex-1 relative">
                <!-- Botão de Fechar -->
                <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                    class="absolute top-0 right-0 text-red-500 hover:text-red-700 text-2xl">
                    &times;
                </button>

                <h2 class="text-2xl font-bold text-blue-600 mb-4">Instruções para gerenciamento de famílias de veículos
                </h2>

                <p class="mb-3 text-sm text-gray-700 leading-relaxed">
                    Esta tela tem como objetivo <strong>exibir as famílias de veículos</strong> cadastradas no sistema,
                    incluindo arquivos de imagem, site de apoio e documentos. Utilize os recursos abaixo para uma busca eficaz:
                </p>

                <ul class="list-disc list-inside text-sm text-gray-800 space-y-2">
                    <li><strong>Nome da família:</strong> Coloque o nome básico do modelo que possa ser reunitilizado e
                        que demonstre ligação de mais subtipos de veiculos. Esse nome será usado para renomear o arquivo
                        e guardar na pasta de imagens.</li>
                    <li><strong>*Imagem da família:</strong> Selecione uma imagem ilustrativa. Arquivos válidos *.jpg.</li>
                    <li><strong>*Arquivo MEV:</strong> Documento específico. Arquivos válidos *.pdf.</li>
                    <li><strong>*Documentos:</strong> Quaisquer documentos auxiliares a venda. Arquivos válidos *.*.</li>
                    <li><strong>Site de Apoio:</strong> Site de apoio para que o vendedor possa consultar mecanismos
                        externos de auxilio a venda, vinculados ao modelo da família, como sites de Detran, montadora,
                        etc. Ex: http://www.montadora.com.br </li>
                    <li><strong>[Voltar para edição do veículo]</strong> Esse botão somente aparece se esta tela for
                        seleciona a partir da tela do cadastro de veículo.</li>
                    <li><strong>Cadastrar ou Alterar Família:</strong> Cadastra ou atualiza os dados da tela.</li>
                    <li><strong>Mostrar todas as famílias no carrossel (mesmo sem veículos):</strong> Esse checkbox,
                        grava no arquivo de configuração se o carrossel da tela de veiculos novos deve mostrar ou não, imagens de familias de unidades
                        sem estoque. *Salva automaticamente sem necesssidade de post no form.</li>
                        <strong>*</strong>Os arquivos podem ser enviados separadamente.

                </ul>

                <div class="mt-6 text-right">
                    <button onclick="document.getElementById('modalAjuda').classList.add('hidden')"
                        class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                        Entendi!
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script opcional para preencher o formulário ao clicar em editar -->
    <script>
        function preencherFormulario(id, descricao, site = '') {
            const form = document.getElementById('formFamilia');
            form.action = `/veiculos/familia/${id}`;

            // Remove qualquer _method anterior
            const oldMethod = form.querySelector('input[name="_method"]');
            if (oldMethod) oldMethod.remove();

            // Adiciona _method PUT
            const methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PUT');
            form.appendChild(methodInput);

            // Preenche os campos
            form.querySelector('input[name="descricao"]').value = descricao;
            form.querySelector('input[name="site"]').value = site;
        }
    </script>

</x-app-layout>

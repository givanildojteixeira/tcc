<x-app-layout> {{-- ✅ Gerenciar famílias de veículos - INDEX - FAMILIA --}}

    <!-- 🔝 Header -->
    <div class="flex flex-col h-screen">
        <div class="flex items-center justify-between gap-4 px-4 py-4 bg-white shadow rounded-md p-4 border">
            <div class="flex items-center gap-4 ">
                @if (request('from') && request('origem'))
                @php
                $voltarPara =
                request('from') === 'create'
                ? route('veiculos.create', ['from' => request('origem')])
                : url('/veiculos/' . request('from') . '/edit?from=' . request('origem'));
                @endphp
                <a href="{{ $voltarPara }}"
                    class="inline-flex items-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-md shadow-sm transition">
                    <i class="fas fa-arrow-left"></i>
                    Voltar para edição do veículo
                </a>
                @endif

                <h2 class="text-2xl font-semibold text-green-700 whitespace-nowrap">
                    Gerenciar Famílias de Veículos
                </h2>
            </div>

            <div class="flex items-center gap-4 ">
                <form method="GET" action="{{ route('familia.index') }}" class="flex items-center gap-2 ">
                    <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar família..."
                        class="min-w-[180px] px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />

                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition flex items-center gap-2">
                        <i class="fas fa-search"></i> Buscar
                    </button>

                    @if (request('busca'))
                    <a href="{{ route('familia.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition flex items-center gap-2">
                        <i class="fas fa-broom"></i> Limpar
                    </a>
                    @endif
                </form>

                <div class="flex items-center gap-2">
                    <x-checkbox-config chave="mostrar_todas_familias"
                        label="Mostrar todas as famílias em Veiculos Novos" />
                    <x-bt-ajuda /><!-- Botão de Ajuda -->
                </div>
            </div>
        </div>

        @if (request('from'))
        @php
        $veiculo = \App\Models\Veiculo::find(request('from'));
        $familia = $veiculo ? \App\Models\Familia::where('descricao', $veiculo->familia)->first() : null;
        @endphp
        @if ($familia)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                        preencherFormulario("{{ $familia->id }}", "{{ $familia->descricao }}", "{{ $familia->site ?? '' }}");
                    });
        </script>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('formFamilia');

                    form.addEventListener('submit', function(e) {
                        const methodField = form.querySelector('input[name="_method"]');
                        const isAlterar = methodField && methodField.value === 'PUT';

                        if (isAlterar) {
                            e.preventDefault();

                            const actionUrl = form.action;
                            const formData = new FormData(form);

                            fetch(actionUrl, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                                        'Accept': 'application/json',
                                    },
                                    body: formData
                                })
                                .then(response => {
                                    if (response.ok) {
                                        window.location.href =
                                            "{{ request('from') === 'create'
                                                ? route('veiculos.create', ['from' => request('origem')])
                                                : url('/veiculos/' . request('from') . '/edit?from=' . request('origem')) }}";
                                    } else {
                                        return response.json().then(err => {
                                            alert("Erro ao alterar: " + (err.message ||
                                                "Verifique os dados."));
                                        });
                                    }
                                })
                                .catch(err => alert("Erro de rede: " + err));
                        }
                    });
                });
        </script>
        @endif

        {{-- Bloco Alterar / Cadastrar Familia --}}
        <div class="flex flex-col md:flex-row items-center justify-center gap-4 px-4 py-4 h-screen"
            style="height: calc(100vh - 180px);">
            <!-- Gerenciamento de familias-->
            <form id="formFamilia" method="POST" action="/veiculos/familia" enctype="multipart/form-data"
                class="border border-gray-300 rounded-lg shadow-lg p-3 overflow-y-auto bg-white"
                style="height: 100%; flex: 3;">
                @csrf

                {{-- selecionar familia --}}
                <div x-data="{ idSelecionado: null }" class="flex flex-wrap gap-1 mb-1">

                    <!-- Nome da Família -->
                    <div class="basis-[10%] min-w-[100px]">
                        <label class="block text-gray-700 font-medium ">Nome:</label>
                        <input type="text" name="descricao" required
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
                    </div>

                    <!-- Site -->
                    <div class="basis-[55%] flex-grow min-w-[180px]">
                        <label class="block text-gray-700 font-medium ">Site de Apoio:</label>
                        <input type="text" name="site"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>

                    <!-- Campo oculto para o ID -->
                    <input type="hidden" name="id" x-model="idSelecionado">

                    <!-- Botão dinâmico -->
                    <button type="submit" id="botaoFamilia" :class="idSelecionado
                            ?
                            'flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600' :
                            'flex items-center gap-1 bg-green-600 hover:bg-green-700' +
                            ' text-white px-3 py-1.5 text-sm rounded-md shadow'" class="transition">
                        <i :class="idSelecionado ? 'fas fa-pen' : 'fas fa-plus-circle'"></i>
                        <span x-text="idSelecionado ? 'Alterar' : 'Cadastrar'"></span>
                    </button>
                    <!-- Botão Limpar -->
                    <button type="button" onclick="resetarFormulario()"
                        class="flex items-center gap-1 bg-gray-300 hover:bg-gray-400 text-gray-800 px-3 py-1.5 text-sm rounded-md shadow">
                        <i class="fas fa-eraser text-sm"></i> Limpar
                    </button>
                </div>

                <div class="flex gap-4">
                    {{-- Upload de arquivos com legenda --}}
                    <fieldset id="Arquivos" class="border border-blue-200 rounded-md p-2 mb-4 w-full bg-blue-100"
                        style="flex: 1.8">
                        <legend class="text-sm font-semibold text-gray-600 px-2"><i class="fas fa-folder"></i> Arquivos
                            da Família</legend>

                        <div class="grid grid-cols-1 gap-3">
                            <!-- 1️⃣ Imagem da Família -->
                            <div class="flex items-center gap-3 w-full">
                                <form action="{{ route('familia.upload', ['tipo' => 'imagem']) }}" method="POST"
                                    enctype="multipart/form-data" class="flex items-center gap-3 w-full">
                                    @csrf
                                    <label class="w-1/4 text-gray-700 font-medium">Imagem Unica</label>
                                    <input type="file" name="arquivo" accept=".jpg,.jpeg"
                                        class="flex-1 border rounded-md text-sm px-2 py-1 file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
                                    <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md text-sm">
                                        <i class="fas fa-cloud-upload-alt mr-1"></i> Upload
                                    </button>
                                </form>
                            </div>

                            <!-- 2️⃣ Arquivo MEV -->
                            <form action="{{ route('familia.upload', ['tipo' => 'mev']) }}" method="POST"
                                enctype="multipart/form-data" class="flex items-center gap-3 w-full">
                                @csrf
                                <label class="w-1/4 text-gray-700 font-medium">Arquivo M.E.V.</label>
                                <input type="file" name="arquivo" accept=".pdf"
                                    class="flex-1 border rounded-md text-sm px-2 py-1 file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md text-sm">
                                    <i class="fas fa-cloud-upload-alt mr-1"></i> Upload
                                </button>
                            </form>

                            <!-- 3️⃣ Documentos -->

                        </div>


                        <!-- 📂 Subgrupo opcional dentro do fieldset principal -->
                        <fieldset
                            class="flex flex-col border border-dashed border-gray-400 rounded-md p-3 mt-1 bg-blue-50 h-full w-full"
                            style="flex: 0.5; max-height: calc(100vh - 500px);">
                            <legend class="text-xs font-semibold text-gray-500 px-2">
                                <i class="fas fa-paperclip"></i> Outros Anexos (opcional) Planilhas, Folders, Campanhas,
                                Material de Apoio, etc. ...
                            </legend>
                            <form action="{{ route('familia.upload', ['tipo' => 'documentos']) }}" method="POST"
                                enctype="multipart/form-data" class="flex items-center gap-3 mt-2">
                                @csrf

                                <!-- ID da família como campo oculto -->
                                <input type="hidden" name="familia_id" id="input_familia_id"
                                    value="{{ $familia->id ?? '' }}">

                                <!-- Campo de upload do arquivo -->
                                <input type="file" name="arquivo" required
                                    class="flex-1 border rounded-md text-sm px-2 py-1 file:bg-green-100 file:text-green-700 hover:file:bg-green-200">

                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md text-sm">
                                    <i class="fas fa-cloud-upload-alt mr-1"></i> Upload
                                </button>
                            </form>


                            {{-- @if(isset($familia))
                            @php
                            $nomeFamilia = Str::slug($familia->descricao, '-');
                            $caminho = public_path('upload/familia');
                            $arquivosExtras = collect(File::files($caminho))->filter(function ($file) use ($nomeFamilia)
                            {
                            return str_starts_with($file->getFilename(), $nomeFamilia . '-');
                            });
                            @endphp
                            @endif --}}



                            <!-- 📄 Lista dinâmica de arquivos já enviados -->
                            <div id="listaArquivosExtras"
                                class="mt-1 bg-white border border-gray-200 rounded-md p-2 shadow-inner">
                                <h4 class="text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-file-alt mr-1"></i> Arquivos Enviados
                                </h4>
                                <p class="text-gray-500 text-sm italic">Selecione uma família para visualizar os anexos.
                                </p>
                            </div>




                        </fieldset>


                    </fieldset>


                    <form method="POST" action="{{ route('cor_familia.relacionar') }}">
                        @csrf

                        <!-- Campo oculto para o ID da família -->

                        <input type="hidden" name="familia_id" id="input_familia_id">

                        <fieldset id="Cores"
                            class="flex flex-col border border-blue-200 rounded-md p-3 mb-4 bg-blue-100 h-full w-full"
                            style="flex: 0.5; max-height: calc(100vh - 330px);">
                            <legend class="text-sm font-semibold text-gray-600 px-2">
                                <i class="fas fa-palette"></i> Paleta de Cores
                            </legend>

                            <!-- Lista com scroll -->
                            <div class="flex-1 overflow-y-auto mt-2 pr-1">
                                <div class="grid grid-cols-1 gap-2 text-sm">
                                    @foreach ($cores as $cor)
                                    <label class="inline-flex items-center gap-2">
                                        <input type="checkbox" class="form-checkbox text-green-600" name="cores[]"
                                            value="{{ $cor->id }}">
                                        {{ $cor->cor_desc }}
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Botão centralizado na parte inferior -->
                            <div class="flex justify-center mt-3">
                                <button id="relacionar" type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md text-sm">
                                    <i class="fas fa-cloud-upload-alt mr-1"></i> Relacionar
                                </button>
                            </div>
                        </fieldset>

                    </form>




                </div>

            </form>

            <!-- Lista  -->
            <div id="listaFamilias" class="border border-gray-300 rounded-lg shadow-lg  overflow-y-auto bg-white"
                style="height: 100%; flex: 1.2; min-width: 450px;">

                <table class="min-w-full border text-sm text-left">
                    <thead class="sticky top-0 z-10 bg-green-50 text-green-800 uppercase">
                        <tr>
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Descrição</th>
                            <th class="px-4 py-2 border">Imagem</th>
                            <th class="px-4 py-2 border text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($familias as $familia)
                        <tr class="hover:bg-gray-50 cursor-pointer"
                            onclick="preencherFormulario('{{ $familia->id }}', '{{ $familia->descricao }}', '{{ $familia->site }}')">

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
    </div>

    <!-- Barra fixa abaixo da tabela -->
    <x-rodape>
        <!-- Número de veículos listados -->
        <div class="font-medium" id="selectedVehiclesCount">
            Familias Listadas: {{ count($familias) }}
        </div>
    </x-rodape>
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
                    incluindo arquivos de imagem, site de apoio e documentos. Utilize os recursos abaixo para uma busca
                    eficaz:
                </p>

                <ul class="list-disc list-inside text-sm text-gray-800 space-y-2">
                    <li><strong>Nome da família:</strong> Coloque o nome básico do modelo que possa ser reunitilizado e
                        que demonstre ligação de mais subtipos de veiculos. Esse nome será usado para renomear o arquivo
                        e guardar na pasta de imagens.</li>
                    <li><strong>*Imagem da família:</strong> Selecione uma imagem ilustrativa. Arquivos válidos *.jpg.
                    </li>
                    <li><strong>*Arquivo MEV:</strong> Documento específico. Arquivos válidos *.pdf.</li>
                    <li><strong>*Documentos:</strong> Quaisquer documentos auxiliares a venda. Arquivos válidos *.*.
                    </li>
                    <li><strong>Site de Apoio:</strong> Site de apoio para que o vendedor possa consultar mecanismos
                        externos de auxilio a venda, vinculados ao modelo da família, como sites de Detran, montadora,
                        etc. Ex: http://www.montadora.com.br </li>
                    <li><strong>[Voltar para edição do veículo]</strong> Esse botão somente aparece se esta tela for
                        seleciona a partir da tela do cadastro de veículo.</li>
                    <li><strong>Cadastrar ou Alterar Família:</strong> Cadastra ou atualiza os dados da tela.</li>
                    <li><strong>Mostrar todas as famílias no carrossel (mesmo sem veículos):</strong> Esse checkbox,
                        grava no arquivo de configuração se o carrossel da tela de veiculos novos deve mostrar ou não,
                        imagens de familias de unidades
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
            if (!form) return;

            form.action = `/veiculos/familia/${id}`;

            // Remove _method antigo
            const oldMethod = form.querySelector('input[name="_method"]');
            if (oldMethod) oldMethod.remove();

            // Adiciona _method PUT
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);

            // Preenche campos
            const inputs = {
                descricao: descricao,
                site: site,
                id: id,
                familia_id: id
            };

            Object.entries(inputs).forEach(([name, value]) => {
                const input = form.querySelector(`input[name="${name}"]`) || document.getElementById(
                    `input_${name}`);
                if (input) input.value = value;
            });

            // Atualiza botão
            const botao = document.getElementById('botaoFamilia');
            if (botao) {
                botao.innerHTML = '<i class="fas fa-pen-to-square text-sm"></i> Alterar';
                botao.classList.remove('bg-green-600', 'hover:bg-green-700');
                botao.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
            }

            // Limpa os checkboxes antes
            const checkboxes = form.querySelectorAll('input[name="cores[]"]');
            checkboxes.forEach(cb => cb.checked = false);
            
            // 🔄 Marca checkboxes de cores via AJAX
            fetch(`/familia/${id}/cores`)
                .then(res => res.json())
                .then(corIds => {
                    // Desmarca todos os checkboxes primeiro
                    document.querySelectorAll('input[name="cores[]"]').forEach(cb => {
                        cb.checked = false;
                    });

                    // Marca os relacionados
                    corIds.forEach(idCor => {
                        const checkbox = document.querySelector(`input[name="cores[]"][value="${idCor}"]`);
                        if (checkbox) checkbox.checked = true;
                    });
                })
                .catch(error => {
                    console.error("Erro ao carregar cores:", error);
                });

            // 🔄 Carrega arquivos anexados dinamicamente
            fetch(`/familia/${id}/arquivos`)
                .then(res => res.json())
                .then(arquivos => {
                    const lista = document.getElementById('listaArquivosExtras');
                    if (!lista) return;

                    lista.innerHTML = ''; // limpa antes de inserir

                    if (arquivos.length === 0) {
                        lista.innerHTML = `<p class="text-gray-500 text-sm italic">Nenhum anexo encontrado.</p>`;
                        return;
                    }

                    const ul = document.createElement('ul');
                    ul.className = 'divide-y divide-gray-200 text-sm';

                    arquivos.forEach(arquivo => {
                        const li = document.createElement('li');
                        li.className = 'flex justify-between items-center py-2';
                        li.innerHTML = `
                            <a href="${arquivo.link}" target="_blank" class="text-blue-600 hover:underline">
                                <i class="fas fa-file mr-1"></i> ${arquivo.nome}
                            </a>
                            
                            <form method="POST" action="{{ route('familia.excluirArquivoSimples') }}">
                                @csrf
                                <input type="hidden" name="arquivo_excluir" value="${arquivo.nome}">
                                <input type="hidden" name="familia" value="${descricao}">
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                    <i class="fas fa-trash-alt"></i> Excluir
                                </button>
                            </form>

                        `;
                        ul.appendChild(li);
                    });

                    lista.appendChild(ul);
                })
                .catch(err => console.error('Erro ao carregar anexos:', err));



        }
    </script>







</x-app-layout>
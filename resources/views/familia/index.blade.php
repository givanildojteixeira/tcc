<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <!-- Título e Feedback -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-green-700">Gerenciar Famílias</h2>
        </div>


        <!-- Formulário -->
        <form id="formFamilia" action="{{ route('familia.store') }}" method="POST" enctype="multipart/form-data" class="mb-8 space-y-4">

            @csrf

            <div class="flex flex-wrap gap-4 mb-4">
                <!-- Nome da Família -->
                <div class="flex-grow basis-[30%] min-w-[250px]">
                    <label class="block text-gray-700 font-medium mb-1">Nome da Família</label>
                    <input type="text" name="descricao" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
                </div>

                <!-- Imagem da Família -->
                <div class="flex-grow basis-[40%] min-w-[250px]">
                    <label class="block text-gray-700 font-medium mb-1">Imagem da Família</label>
                    <input type="file" name="imagem" accept=".jpg,.jpeg"
                        class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                               file:rounded-md file:border-0
                               file:text-sm file:font-semibold
                               file:bg-green-100 file:text-green-700
                               hover:file:bg-green-200">
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-4 mb-6">
                @if(request('from'))
                <a href="{{ url('/veiculos/' . request('from') . '/edit') }}"
                    class="inline-flex items-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-md shadow-sm transition">
                    <i class="fas fa-arrow-left"></i>
                    Voltar para edição do veículo
                </a>
                @endif

                <button type="submit"
                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md shadow-md">
                    <i class="fas fa-plus-circle"></i>
                    Cadastrar ou Alterar Família
                </button>
            </div>


        </form>
        <!-- Lista de Famílias -->
        <div class="overflow-x-auto">
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
                                onclick="preencherFormulario('{{ $familia->id }}', '{{ $familia->descricao }}')"
                                class="text-blue-600 hover:text-blue-800" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @if ($familias->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Nenhuma família cadastrada.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script opcional para preencher o formulário ao clicar em editar -->
    <script>
        function preencherFormulario(id, descricao) {
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

            form.querySelector('input[name="descricao"]').value = descricao;
        }
    </script>

</x-app-layout>
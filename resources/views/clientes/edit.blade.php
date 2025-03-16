<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastro de Clientes') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                        Edição de Clientes
                    </h2>

                    {{-- Botao para listar clientes - somente para quem tem acesso --}}
                    @can('level')
                        <p class="mb-4 p-6">
                            <a href="{{ route('cliente.index') }}" class="bg-blue-500 text-white rounded p-2">Lista de
                                Clientes</a>
                        </p>
                    @endcan

                    <p class="mb-4 p-6">
                        <a href="{{ route('meus-clientes', Auth::user()->id) }}"
                            class="bg-blue-500 text-white rounded p-2">Lista de
                            Clientes</a>
                    </p>
                    {{-- Mensagem de confirmação --}}
                    @if (session('msg'))
                        <p class="bg-blue-500 p-2 rounded text-center text-white mb-4">{{ session('msg') }}</p>
                    @endif

                    {{-- formulario --}}
                    <form action="{{ route('cliente.update', $cliente->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <fieldset class="border-2 rouded p-6">
                            <legend> Preencha todos os campos</legend>

                            {{-- relacionamento --}}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" value="{{ $cliente->nome }}"
                                    class="w-full rounded" required autofocus>
                            </div>
                            <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" id="email" value="{{ $cliente->email }}"
                                    class="w-full rounded" required>
                            </div>
                            <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                                <label for="telefone">Telefone</label>
                                <input type="tel" name="telefone" id="telefone" value="{{ $cliente->telefone }}"
                                    class="w-full rounded" required>
                            </div>
                            <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                                <label for="telefonecom">Telefone Comercial</label>
                                <input type="tel" name="telefonecom" id="telefonecom"
                                    value="{{ $cliente->telefonecom }}" class="w-full rounded" required>
                            </div>
                            <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                                <label for="endereco">Endereço</label>
                                <input type="text" name="endereco" id="endereco" value="{{ $cliente->endereco }}"
                                    class="w-full rounded" required>
                            </div>
                            <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                                <label for="bairro">Bairro</label>
                                <input type="text" name="bairro" id="bairro" value="{{ $cliente->bairro }}"
                                    class="w-full rounded" required>
                            </div>
                            <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                                <label for="cidade">Cidade</label>
                                <input type="text" name="cidade" id="cidade" value="{{ $cliente->cidade }}"
                                    class="w-full rounded" required>
                            </div>
                            <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                                <label for="uf">UF</label>
                                <input type="text" name="uf" id="uf" value="{{ $cliente->uf }}"
                                    class="w-full rounded" required>
                            </div>
                            <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                                <label class="block font-semibold">Sexo</label>
                                <div class="flex gap-4 mt-2">
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="sexo" value="Masculino"
                                            {{ $cliente->sexo == 'Masculino' ? 'checked' : '' }} required>
                                        Masculino
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="sexo" value="Feminino"
                                            {{ $cliente->sexo == 'Feminino' ? 'checked' : '' }} required>
                                        Feminino
                                    </label>
                                </div>
                            </div>

                            {{-- botoes --}}
                            <div class="bg-gray-100 p-4 rounded overflow-hidden">
                                <input type="submit" value="Cadastrar" class="bg-blue-500 text-white rounded p-2">
                                 </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

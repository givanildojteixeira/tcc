<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {{ __("You're logged in!") }} --}}
                    <p class="mb-4 text-center">Bem Vindo <strong>{{ Auth::user()->name }}</strong></p>
                    <p class="mb-4">Exibindo detalhes do cliente: <strong> {{ $cliente->nome }}</strong></p>
                    <p>
                        <a href="{{ route('meus-clientes', auth::user()->id) }}"
                            class="bg-blue-500 text-white rounded p-2"> Meus Clientes
                        </a>
                        <a href="{{ route('cliente.edit', $cliente->id) }}"
                            class="bg-gray-500 text-white rounded p-2">Editar Dados
                        </a>
                        <a href="{{ route('confirma_delete', $cliente->id) }}" class="bg-red-500 text-white rounded p-2"> Deletar Cliente
                        </a>
                    </p>
                </div>
                <div class="p-6 text-gray-900">
                    <p><strong>Nome :</strong>{{ $cliente->nome }}</p>
                    <p><strong>E-mail :</strong>{{ $cliente->email }}</p>
                    <p><strong>Telefone :</strong>{{ $cliente->telefone }} | <strong>Telefone Com
                            :</strong>{{ $cliente->telefonecom }}</p>
                    <p><strong>Endereço :</strong>{{ $cliente->endereco }}</p>
                    <p><strong>Bairro :</strong>{{ $cliente->bairro }}</p>
                    <p><strong>Cidade :</strong>{{ $cliente->cidade }}</p>
                    <p><strong>Estado :</strong>{{ $cliente->uf }}</p>
                </div>




            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Usuários') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4">Olá <strong>{{ Auth::user()->name}}</strong></p>
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="p-3 bg-gray-100 rounded-lg mb-4">
                        {{ $users->links() }}
                    </div>

                   <table class="table-auto w-full">
                    <thead class="text-left bg-gray-100">
                        <tr>
                            <th class="text-center">Nível</th>
                            <th class="p-4">Nome</th>
                            <th>E-mail</th>
                            <th>Data de cadastro</th>
                            @can('level')
                                <th class="text-center">Ações</th>
                            @endcan
                        </tr>
                    </thead>

                    <body>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-100">
                                <th class="text-center">
                                    @if ($user->level == 'admin')
                                        <i class="fa-solid fa-user-tie"></i>
                                    @endif
                                </th>
                                <td class="p-2">{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->created_at}}</td>

                                @can('level')
                                    <td class="text-center">
                                        <a href="{{ route('user.edit',$user->id)}}">Editar</a>
                                    </td>
                                @endcan

                            </tr>
                        @endforeach
                    </body>
                   </table>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>

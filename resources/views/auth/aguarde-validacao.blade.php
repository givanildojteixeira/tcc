<x-guest-layout>
    <div class="text-center max-w-lg mx-auto mt-16 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Cadastro realizado com sucesso!</h1>
        <p class="text-gray-600 text-lg mb-6">
            Seu usuário foi criado, mas ainda não está liberado para acessar o sistema.
            <br>Por favor, aguarde a validação por um administrador.
        </p>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Sair
        </a>

        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
            @csrf
        </form>
    </div>
</x-guest-layout>

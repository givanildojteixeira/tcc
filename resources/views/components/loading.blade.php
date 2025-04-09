<div
    x-data="{ loading: false }"
    x-show="loading"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white p-6 rounded-lg shadow-lg flex items-center gap-4">
        <svg class="animate-spin h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        <span class="text-blue-700 font-medium">Carregando, por favor aguarde...</span>
    </div>
</div>

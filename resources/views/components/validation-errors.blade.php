<div x-data="{ mostrar: true }" x-show="mostrar" class="flex bg-red-100 border border-red-300 text-red-700 rounded-md shadow-md p-4 mb-6 max-w-2xl mx-auto">
    <div class="flex-shrink-0">
        <i class="fas fa-exclamation-triangle text-red-500 text-2xl mr-4"></i>
    </div>
    <div class="flex-1">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-bold text-red-600">Erros de Validação</h2>
            <button @click="mostrar = false" class="text-red-500 hover:text-red-700 text-lg">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <hr class="border-red-300 mb-3">
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>

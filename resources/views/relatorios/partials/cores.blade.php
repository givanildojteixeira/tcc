<div class="flex justify-center">
    <div class="grid grid-cols-2 gap-x-8 font-semibold text-gray-600 border-b pb-1 w-full max-w-2xl">
        <div class="text-right w-20">ID</div>
        <div>Descrição da Cor</div>
    </div>
</div>

@forelse ($cores as $cor)
    <div class="flex justify-center">
        <div class="grid grid-cols-2 gap-x-8 border-b py-1 text-sm text-gray-800 w-full max-w-2xl">
            <div class="text-right w-20">{{ $cor->id }}</div>
            <div>{{ $cor->cor_desc }}</div>
        </div>
    </div>
@empty
    <p class="text-center text-gray-500 py-4">Nenhuma cor encontrada.</p>
@endforelse

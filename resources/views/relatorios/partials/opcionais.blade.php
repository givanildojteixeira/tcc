<div class="space-y-4">
    @forelse ($opcionais as $o)
        <div class="border rounded-md p-4 shadow-sm bg-white text-sm text-gray-800">
            {{-- Primeira linha: Modelo | Código | Chassi --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="sm:w-1/3"><strong>Modelo:</strong> {{ $o->modelo_fab ?? '-' }}
                    <strong>Código:</strong> {{ $o->cod_opcional ?? '-' }}
                    <strong>Chassi:</strong> {{ $o->chassi ?? '-' }}
                </div>
            </div>

            {{-- Segunda linha: Descrição --}}
            <div class="mt-2 border-t pt-2 text-gray-700">
                <strong>Descrição:</strong> {{ $o->descricao ?? '-' }}
            </div>
        </div>
    @empty
        <p class="text-center text-gray-500 py-4">Nenhum opcional encontrado.</p>
    @endforelse
</div>
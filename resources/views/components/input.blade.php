{{-- resources/views/components/input.blade.php --}}
@props([
    'label',
    'name',
    'type' => 'text',
    'mask' => null, // novo atributo opcional
])

<div class="flex flex-col">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes }}
        class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 w-full"
        x-init="
            () => {
                if ('{{ $mask }}') {
                    let m = {
                        cpf: '999.999.999-99',
                        cnpj: '99.999.999/9999-99',
                        telefone: '(99) 9999-9999',
                        celular: '(99) 99999-9999',
                        placa: 'AAA-9A99',
                        moeda: { alias: 'currency', prefix: 'R$ ', groupSeparator: '.', radixPoint: ',', autoUnmask: true }
                    };
                    Inputmask(m['{{ $mask }}'] ?? '{{ $mask }}').mask($el);
                }
            }
        "
    />
</div>

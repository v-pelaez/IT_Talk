@props([
    'modelo',
    'accion',
    'metodo' => 'POST',
    'submitText' => 'Guardar',
    'solo' => null,
    'excepto' => [],
    'ocultos' => [],
])

@php
    /** @var \Illuminate\Database\Eloquent\Model $modelo */

    if ($solo) {
        $camposRaw = is_array($solo) ? $solo : explode(',', $solo);
    } else {
        $camposRaw = !$modelo->exists ? $modelo->getFillable() : array_keys($modelo->getAttributes());
    }

    $sistemaOculto = [
        'id',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'two_factor_secret',
        'email_verified_at',
    ];
    $usuarioExcepto = is_array($excepto) ? $excepto : explode(',', $excepto);
    $aQuitar = array_merge($sistemaOculto, $usuarioExcepto, array_keys($ocultos));

    $campos = array_diff($camposRaw, $aQuitar);
    $filaArray = $modelo->toArray();
@endphp

<form method="POST" action="{{ $accion }}"
    {{ $attributes->merge(['class' => 'space-y-6 bg-white p-6 border border-[#e1e8ed] rounded-xl shadow-none']) }}>
    @csrf
    @if (in_array(strtoupper($metodo), ['PATCH', 'PUT', 'DELETE']))
        @method($metodo)
    @endif

    {{-- CAMPOS OCULTOS --}}
    @foreach ($ocultos as $nombre => $valor)
        <input type="hidden" name="{{ $nombre }}" value="{{ $valor }}">
    @endforeach

    <div class="grid grid-cols-1 gap-6">
        @foreach ($campos as $campo)
            <div>

                <label for="{{ $campo }}"
                    class="block text-xs font-bold text-[#657786] uppercase tracking-wider mb-1 ms-1">
                    {{ __(ucfirst(str_replace('_', ' ', $campo))) }}
                </label>

                @php
                    $valor = old($campo, $filaArray[$campo] ?? '');
                    $tipo = 'text';
                    if (str_contains($campo, 'email')) {
                        $tipo = 'email';
                    }
                    if (str_contains($campo, 'date') || str_contains($campo, 'at')) {
                        $tipo = 'date';
                    }

                    $inputClasses =
                        'mt-1 block w-full border-[#ccd6dd] focus:border-[#1da1f2] focus:ring-1 focus:ring-[#1da1f2] rounded-lg bg-[#f5f8fa] text-[#14171a] transition duration-200';
                @endphp

                @if ($campo === 'body' || $campo === 'content' || strlen($valor) > 100)
                    <textarea id="{{ $campo }}" name="{{ $campo }}" rows="5" class="{{ $inputClasses }} resize-none p-3">{{ $valor }}</textarea>
                @else
                    <input id="{{ $campo }}" name="{{ $campo }}" type="{{ $tipo }}"
                        value="{{ $valor }}" class="{{ $inputClasses }} h-11 px-4">
                @endif


                @error($campo)
                    <p class="text-red-500 text-xs mt-1 font-semibold ms-1 italic">{{ $message }}</p>
                @enderror
            </div>
        @endforeach
    </div>


    <div class="flex items-center justify-end gap-4 border-t border-[#e1e8ed] pt-6 mt-4">
        <x-primary-button
            class="bg-[#1da1f2] hover:bg-[#1991db] text-white px-8 py-2.5 rounded-full font-bold text-sm shadow-sm transition active:scale-95">
            {{ __($submitText) }}
        </x-primary-button>
    </div>
</form>

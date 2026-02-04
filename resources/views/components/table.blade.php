@props(['datos', 'solo' => null, 'excepto' => [], 'prefijo' => null])

@php
    $items = method_exists($datos, 'items') ? $datos->items() : $datos;
    $coleccion = collect($items);
    $primerRegistro = $coleccion->first()
        ? (is_array($coleccion->first())
            ? $coleccion->first()
            : $coleccion->first()->toArray())
        : [];

    $columnasRaw = $solo ? (is_array($solo) ? $solo : explode(',', $solo)) : array_keys($primerRegistro);
    $sistemaOculto = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'email_verified_at',
    ];
    $usuarioExcepto = is_array($excepto) ? $excepto : explode(',', $excepto);
    $columnasFinales = array_diff($columnasRaw, $sistemaOculto, $usuarioExcepto);
@endphp

<div class="py-4 px-2">
    <div class="bg-white border border-[#e1e8ed] rounded-xl overflow-hidden shadow-none">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-[#f5f8fa] border-b border-[#e1e8ed] text-[#657786]">
                    <tr>
                        @foreach ($columnasFinales as $columna)
                            <th class="px-6 py-3 font-bold uppercase tracking-wider text-[11px]">
                                {{ __(ucfirst(str_replace('_', ' ', $columna))) }}
                            </th>
                        @endforeach
                        @can(['edit.users', 'delete.users'])
                            @if ($prefijo)
                                <th class="px-6 py-3 font-bold text-center text-[11px]">{{ __('ACCIONES') }}</th>
                            @endif
                        @endcan
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#e1e8ed]">
                    @forelse($datos as $fila)
                        @php
                            $f = is_array($fila) ? $fila : $fila->toArray();
                            $id = $f['id'] ?? null;
                            $nombreMostrar = $f['name'] ?? ($f['title'] ?? $id);
                        @endphp
                        <tr class="hover:bg-[#f5f8fa] transition-colors duration-200">
                            @foreach ($columnasFinales as $columna)
                                <td class="px-6 py-4 whitespace-nowrap text-[#14171a]">
                                    @if ($columna == 'email' || $columna == 'user')
                                        <span class="text-[#1da1f2] hover:underline cursor-pointer">
                                            {{ $f[$columna] ?? '—' }}
                                        </span>
                                    @else
                                        {{ $f[$columna] ?? '—' }}
                                    @endif
                                </td>
                            @endforeach
                            @can(['edit.users', 'delete.users'])
                                @if ($prefijo && $id)
                                    <td class="px-6 py-4 whitespace-nowrap text-center space-x-4">
                                        {{-- Link Editar  --}}
                                        <a href="{{ route($prefijo . '.edit', $id) }}"
                                            class="text-[#1da1f2] hover:text-[#1991db] font-bold text-xs uppercase tracking-tighter transition">
                                            <i class="fas fa-edit mr-1"></i>{{ __('Edit') }}
                                        </a>

                                        {{-- Botón Eliminar --}}
                                        <button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $id }}')"
                                            class="text-[#657786] hover:text-red-500 font-bold text-xs uppercase tracking-tighter transition">
                                            <i class="fas fa-trash-alt mr-1"></i>{{ __('Delete') }}
                                        </button>

                                        {{-- Modal de Confirmación --}}
                                        <x-modal name="confirm-delete-{{ $id }}" focusable>
                                            <form method="post" action="{{ route($prefijo . '.delete', $id) }}"
                                                class="p-8 text-left bg-white">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-xl font-black text-[#14171a] tracking-tight">
                                                    {{ __('¿Eliminar a :name?', ['name' => $nombreMostrar]) }}
                                                </h2>

                                                <p class="mt-3 text-sm text-[#657786] leading-relaxed">
                                                    {{ __('Esta acción es permanente. Se requiere tu contraseña para confirmar la baja del registro.') }}
                                                </p>

                                                <div class="mt-6">
                                                    <x-text-input id="password-{{ $id }}" name="password"
                                                        type="password"
                                                        class="block w-full border-[#ccd6dd] focus:border-[#1da1f2] focus:ring-[#1da1f2] rounded-lg bg-[#f5f8fa]"
                                                        placeholder="{{ __('Tu contraseña') }}" required />
                                                </div>

                                                <div class="mt-8 flex justify-end gap-3">
                                                    <button type="button" x-on:click="$dispatch('close')"
                                                        class="px-4 py-2 text-sm font-bold text-[#657786] hover:text-[#14171a]">
                                                        {{ __('Volver') }}
                                                    </button>

                                                    <button type="submit"
                                                        class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-full text-sm transition shadow-sm">
                                                        {{ __('Eliminar permanentemente') }}
                                                    </button>
                                                </div>

                                            </form>
                                        </x-modal>
                                    </td>
                                @endif
                            </tr>
                        @endcan
                    @empty
                        <tr>
                            <td colspan="100" class="px-6 py-20 text-center">
                                <i class="fa-solid fa-bug text-[#ccd6dd] text-4xl mb-3"></i>
                                <p class="text-[#657786] italic text-sm font-medium">No se encontraron registros en el
                                    sistema.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    @if (method_exists($datos, 'links'))
        <div class="mt-8">
            {{ $datos->links() }}
        </div>
    @endif
</div>

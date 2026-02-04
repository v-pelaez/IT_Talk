<section class="space-y-6">
    <header>
        <h2 class="text-lg font-black text-[#14171a] tracking-tight">
            {{ auth()->id() === $user->id ? __('Borrar mi cuenta permanentemente') : __('Eliminar usuario: ') . $user->name }}
        </h2>

        <p class="mt-1 text-sm text-[#657786] leading-snug">
            {{ __('Una vez que la cuenta sea eliminada, todos sus recursos y datos (incluyendo posts y comentarios) se borrarán de forma irreversible. Por favor, asegúrate de que esta acción es necesaria.') }}
        </p>
    </header>

    {{-- Botón que lanza el modal --}}
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        {{ auth()->id() === $user->id ? __('Eliminar mi cuenta definitivamente') : __('Eliminar este usuario definitivamente') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.delete', $user->id) }}" class="p-8 bg-white border-2 border-red-500 rounded-xl">
            @csrf
            @method('delete')

            <div class="flex items-center text-red-600 mb-4">
                <i class="fa-solid fa-triangle-exclamation text-2xl mr-3"></i>
                <h2 class="text-xl font-black tracking-tight">
                    {{ __('¿Estás absolutamente seguro?') }}
                </h2>
            </div>

            <p class="text-sm text-[#657786] leading-relaxed">
                @if(auth()->id() === $user->id)
                    {{ __('Esta acción no se puede deshacer. Para confirmar que realmente deseas eliminar TU cuenta de IT-TALK, por favor introduce tu contraseña a continuación.') }}
                @else
                    {{ __('Estás a punto de eliminar la cuenta de ') }} <strong>{{ $user->name }}</strong>. {{ __('Esta acción es irreversible y borrará todo su contenido.') }}
                @endif
            </p>

            {{-- Contraseña solo si es "Self-Delete" --}}
            @if(auth()->id() === $user->id)
                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full h-12"
                        placeholder="{{ __('Introduce tu contraseña para confirmar') }}"
                    />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>
            @else
                <div class="mt-6 p-4 bg-red-50 border border-red-100 rounded-lg">
                    <p class="text-xs font-bold text-red-700 uppercase flex items-center">
                        <i class="fa-solid fa-shield-halved mr-2 text-sm"></i>
                        {{ __('Confirmación de Administrador requerida') }}
                    </p>
                </div>
            @endif

            <div class="mt-8 flex justify-end items-center space-x-4">
                {{-- Botón de Cancelar --}}
                <x-secondary-button x-on:click="$dispatch('close')" class="border-none hover:bg-transparent text-[#657786] font-bold">
                    {{ __('Mejor no, volver atrás') }}
                </x-secondary-button>

                {{-- Botón de Confirmar --}}
                <x-danger-button class="px-6 py-3">
                    {{ auth()->id() === $user->id ? __('Sí, borrar mi cuenta') : __('Sí, borrar este usuario') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
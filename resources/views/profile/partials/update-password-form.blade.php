<section>
    <header>
        <h2 class="text-lg font-black text-[#14171a] tracking-tight">
            {{ __('Cambiar Contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-[#657786] leading-snug">
            {{ __('Mantén tu cuenta segura usando una clave aleatoria y difícil de adivinar.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.password.admin', $user->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- SOLO mostrar 'Contraseña Actual' si el usuario se edita a SÍ MISMO --}}
        @if (auth()->user()->id === $user->id)
            <div>
                <x-input-label for="current_password" :value="__('Contraseña Actual')" />
                <x-text-input id="current_password" name="current_password" type="password"
                    class="mt-1 block w-full h-11" />
                <x-input-error :messages="$errors->get('current_password')" />
            </div>
        @endif

        {{-- Nueva Contraseña  --}}
        <div>
            <x-input-label for="password" :value="__('Nueva Contraseña para ' . $user->name)" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full h-11" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        {{-- Confirmar Nueva Contraseña --}}
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Nueva Contraseña')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full h-11 px-4" autocomplete="new-password" placeholder="Repite tu nueva clave" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ __('Actualizar Clave') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold text-green-600 uppercase tracking-tighter italic">
                    <i class="fas fa-check-circle mr-1"></i> {{ __('¡Cambiada con éxito!') }}
                </p>
            @endif
        </div>
    </form>
</section>

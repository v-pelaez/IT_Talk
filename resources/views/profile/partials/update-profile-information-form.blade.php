<section>
    <header>
        <h2 class="text-lg font-black text-[#14171a] tracking-tight">
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-1 text-sm text-[#657786] leading-snug">
            {{ __("Actualiza los detalles de tu cuenta y la dirección de correo electrónico institucional.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    @php
        $userId = request()->route('user') ?? auth()->id();
    @endphp

    <form method="post" action="{{ route('profile.update', $userId) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nombre de Usuario')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full h-11 px-4" 
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        @role('admin')
            <div>
                <x-input-label for="role" :value="__('Privilegios del Sistema (Rol)')" />
                <select id="role" name="role"
                    class="mt-1 block w-full h-11 border-[#ccd6dd] focus:border-[#1da1f2] focus:ring-1 focus:ring-[#1da1f2] rounded-lg bg-[#f5f8fa] text-[#14171a] font-bold text-sm transition duration-200">
                    <option value="" disabled>{{ __('Seleccione un nivel de acceso') }}</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                            {{ strtoupper($role->name) }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('role')" />
            </div>
        @endrole

        <div>
            <x-input-label for="email" :value="__('Dirección de Enlace (Email)')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full h-11 px-4" 
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-xs font-bold text-yellow-800 uppercase tracking-tight">
                        <i class="fas fa-exclamation-triangle mr-1"></i> {{ __('Tu correo no ha sido verificado.') }}
                    </p>
                    <button form="send-verification"
                        class="mt-2 text-xs font-black text-[#1da1f2] hover:underline uppercase tracking-widest">
                        {{ __('Reenviar código de validación') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-green-600 italic">
                            {{ __('Se ha enviado un nuevo enlace a tu bandeja de entrada.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>{{ __('Guardar Cambios') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold text-green-600 uppercase tracking-tighter italic">
                    <i class="fas fa-check-circle mr-1"></i> {{ __('Perfil actualizado.') }}
                </p>
            @endif
        </div>
    </form>
</section>
<x-guest-layout>
    <div class="bg-white border border-[#e1e8ed] rounded-xl overflow-hidden">

        <div class="bg-[#f5f8fa] p-6 border-b border-[#e1e8ed] text-center">
            <h2 class="font-black text-2xl text-[#14171a] tracking-tight">
                {{ __('Entrar a IT-TALK') }}
            </h2>
        </div>

        <div class="p-8">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    <x-text-input id="email" class="block mt-1 w-full h-11" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" placeholder="tu@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <div class="flex justify-between items-center mb-1">
                        <x-input-label for="password" :value="__('Contraseña')" />
                        @if (Route::has('password.request'))
                            <a class="text-[11px] font-bold text-[#1da1f2] hover:underline uppercase tracking-tighter"
                                href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu clave?') }}
                            </a>
                        @endif
                    </div>

                    <x-text-input id="password" class="block mt-1 w-full h-11" type="password" name="password" required
                        autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-6 ms-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-[#1da1f2] shadow-sm focus:ring-[#1da1f2]"
                            name="remember">
                        <span
                            class="ms-2 text-sm text-[#657786] group-hover:text-[#14171a] transition-colors">{{ __('Recordarme') }}</span>
                    </label>
                </div>

                <div class="mt-8">
                    <x-primary-button
                        class="w-full justify-center h-12 text-base bg-[#1da1f2] hover:bg-[#1a91da] active:bg-[#1984c4] transition-all duration-200 shadow-md hover:shadow-lg">
                        {{ __('Iniciar Sesión') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="bg-[#f5f8fa] p-6 border-t border-[#e1e8ed] text-center">
            <p class="text-sm text-[#657786]">
                {{ __('¿No tienes cuenta en IT-TALK?') }}
                <a href="{{ route('register') }}" class="font-bold text-[#1da1f2] hover:underline">
                    {{ __('Regístrate ahora') }}
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>

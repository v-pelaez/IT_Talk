<x-guest-layout>
    <div class="max-w-md mx-auto bg-white border border-[#e1e8ed] rounded-xl overflow-hidden shadow-none">
        
        <div class="bg-[#f5f8fa] p-6 border-b border-[#e1e8ed] text-center">
            <i class="fa-solid fa-user-plus text-[#1da1f2] text-3xl mb-3"></i>
            <h2 class="font-black text-2xl text-[#14171a] tracking-tight">
                {{ __('Únete a IT-TALK') }}
            </h2>
            <p class="mt-2 text-sm text-[#657786] leading-snug">
                {{ __('Crea tu cuenta y empieza a compartir conocimiento.') }}
            </p>
        </div>

        <div class="p-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Nombre Completo')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="dev@it-talk.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-8 flex flex-col gap-4">
                    <x-primary-button class="w-full justify-center py-3">
                        {{ __('Crear mi cuenta') }}
                    </x-primary-button>

                    <a class="text-center text-xs font-bold text-[#657786] hover:text-[#1da1f2] uppercase tracking-widest transition" href="{{ route('login') }}">
                        {{ __('¿Ya tienes cuenta? Inicia sesión') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
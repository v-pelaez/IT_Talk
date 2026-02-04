<x-guest-layout>
    <div class="max-w-md mx-auto bg-white border border-[#e1e8ed] rounded-xl overflow-hidden shadow-none">
        
        <div class="bg-[#f5f8fa] p-6 border-b border-[#e1e8ed] text-center">
            <i class="fa-solid fa-lock-open text-[#1da1f2] text-3xl mb-3"></i>
            <h2 class="font-black text-2xl text-[#14171a] tracking-tight">
                {{ __('Nueva Contraseña') }}
            </h2>
            <p class="mt-2 text-sm text-[#657786] leading-snug">
                {{ __('Establece tus nuevas credenciales para volver a IT-TALK.') }}
            </p>
        </div>

        <div class="p-8">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    <x-text-input id="email" class="block mt-1 w-full h-11 px-4 opacity-75 bg-gray-50" 
                                 type="email" name="email" 
                                 :value="old('email', $request->email)" 
                                 required readonly autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="password" :value="__('Nueva Contraseña')" />
                    <x-text-input id="password" class="block mt-1 w-full h-11 px-4" 
                                 type="password" name="password" 
                                 required autofocus autocomplete="new-password" 
                                 placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Nueva Contraseña')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full h-11 px-4"
                                 type="password"
                                 name="password_confirmation" 
                                 required autocomplete="new-password" 
                                 placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-8">
                    <x-primary-button class="w-full justify-center py-3 text-base">
                        {{ __('Actualizar Contraseña') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-6 text-center">
        <p class="text-[10px] text-[#657786] uppercase tracking-[0.2em] font-bold">
            IT-TALK Security Protocol v2.0
        </p>
    </div>
</x-guest-layout>
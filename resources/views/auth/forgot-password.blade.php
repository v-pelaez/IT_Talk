<x-guest-layout>
    <div class="max-w-md mx-auto bg-white border border-[#e1e8ed] rounded-xl overflow-hidden shadow-none">
        
        <div class="bg-[#f5f8fa] p-6 border-b border-[#e1e8ed] text-center">
            <i class="fa-solid fa-key text-[#1da1f2] text-3xl mb-3"></i>
            <h2 class="font-black text-xl text-[#14171a] tracking-tight">
                {{ __('¿Olvidaste tu contraseña?') }}
            </h2>
            <p class="mt-2 text-sm text-[#657786] leading-snug">
                {{ __('No hay problema. Dinos tu email y te enviaremos un enlace para que elijas una nueva.') }}
            </p>
        </div>

        <div class="p-8">
            <x-auth-session-status class="mb-4 font-bold text-green-600 text-sm italic" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    
                    <x-text-input id="email" 
                                 class="block mt-1 w-full bg-[#f5f8fa] border-[#ccd6dd] focus:border-[#1da1f2] focus:ring-[#1da1f2] rounded-lg h-11 px-4" 
                                 type="email" 
                                 name="email" 
                                 :value="old('email')" 
                                 required 
                                 autofocus 
                                 placeholder="ejemplo@it-talk.com" />
                    
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex flex-col gap-4 mt-8">
                    <x-primary-button class="w-full justify-center py-2.5 text-sm font-bold rounded-full bg-[#1da1f2] hover:bg-[#1991db] shadow-sm">
                        {{ __('Enviar enlace de recuperación') }}
                    </x-primary-button>

                    <a href="{{ route('login') }}" class="text-center text-xs font-bold text-[#657786] hover:text-[#1da1f2] transition uppercase tracking-widest">
                        <i class="fas fa-arrow-left mr-1"></i> {{ __('Volver al inicio de sesión') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-6 text-center">
        <p class="text-[10px] text-[#657786] uppercase tracking-[0.2em] font-medium">
            IT-TALK Security System Service
        </p>
    </div>
</x-guest-layout>
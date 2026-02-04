<x-guest-layout>
    <div class="max-w-md mx-auto bg-white border border-[#e1e8ed] rounded-xl overflow-hidden shadow-none">
        
        <div class="bg-[#f5f8fa] p-6 border-b border-[#e1e8ed] text-center">
            <i class="fa-solid fa-envelope-open-text text-[#1da1f2] text-4xl mb-3 animate-bounce"></i>
            <h2 class="font-black text-xl text-[#14171a] tracking-tight">
                {{ __('¡Casi listo!') }}
            </h2>
            <p class="mt-2 text-sm text-[#657786] leading-snug">
                {{ __('Gracias por unirte a IT-TALK. Antes de empezar, ¿podrías verificar tu cuenta con el enlace que te enviamos?') }}
            </p>
        </div>

        <div class="p-8">
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 p-3 bg-green-50 border border-green-200 rounded-lg flex items-start">
                    <i class="fa-solid fa-circle-check text-green-500 mt-0.5 mr-2"></i>
                    <p class="text-xs font-bold text-green-700 uppercase tracking-tight">
                        {{ __('Se ha enviado un nuevo enlace de verificación a tu correo.') }}
                    </p>
                </div>
            @endif

            <div class="flex flex-col gap-4">
                {{-- Botón Principal de Reenvío --}}
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="w-full justify-center py-3">
                        {{ __('Reenviar correo de verificación') }}
                    </x-primary-button>
                </form>

                {{-- Botón Secundario de Cerrar Sesión --}}
                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button type="submit" class="text-xs font-black text-[#657786] hover:text-[#14171a] uppercase tracking-widest transition">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i>
                        {{ __('Cerrar Sesión') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-6 text-center">
        <p class="text-[10px] text-[#657786] font-medium italic">
            ¿No encuentras el correo? Revisa tu carpeta de spam.
        </p>
    </div>
</x-guest-layout>
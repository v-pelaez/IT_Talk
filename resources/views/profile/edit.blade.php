<x-app-layout>
    <x-slot name="header">
        {{ __('Configuración de la Cuenta') }}
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-8 pb-12">
        
        {{-- Bloque: Información del Perfil --}}
        <div class="bg-white border border-[#e1e8ed] sm:rounded-xl overflow-hidden shadow-none">
            <div class="bg-[#f5f8fa] px-6 py-4 border-b border-[#e1e8ed]">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-address-card text-[#1da1f2] text-lg"></i>
                    <h3 class="text-lg font-black text-[#14171a] tracking-tight">{{ __('Información Personal') }}</h3>
                </div>
                <p class="text-xs text-[#657786] font-medium uppercase tracking-widest mt-1">
                    {{ __('Actualiza tu nombre de usuario y dirección de correo.') }}
                </p>
            </div>
            <div class="p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        {{-- Bloque: Actualizar Contraseña --}}
        <div class="bg-white border border-[#e1e8ed] sm:rounded-xl overflow-hidden shadow-none">
            <div class="bg-[#f5f8fa] px-6 py-4 border-b border-[#e1e8ed]">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-key text-[#1da1f2] text-lg"></i>
                    <h3 class="text-lg font-black text-[#14171a] tracking-tight">{{ __('Seguridad') }}</h3>
                </div>
                <p class="text-xs text-[#657786] font-medium uppercase tracking-widest mt-1">
                    {{ __('Asegúrate de usar una contraseña larga y aleatoria.') }}
                </p>
            </div>
            <div class="p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        {{-- Bloque: Eliminar Cuenta  --}}
        <div class="bg-white border border-[#e1e8ed] sm:rounded-xl overflow-hidden shadow-none">
            <div class="bg-[#fff1f0] px-6 py-4 border-b border-[#ffa39e]">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-lg"></i>
                    <h3 class="text-lg font-black text-red-600 tracking-tight">{{ __('Zona de Peligro') }}</h3>
                </div>
                <p class="text-xs text-red-500 font-medium uppercase tracking-widest mt-1">
                    {{ __('Esta acción es permanente y borrará todos tus datos.') }}
                </p>
            </div>
            <div class="p-6 sm:p-8 border-t border-[#ffa39e]">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
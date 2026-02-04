<x-app-layout>
    <x-slot name="header">
        {{ __('Usuarios') }}
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border-x border-t border-[#e1e8ed] p-4 rounded-t-xl mt-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa-solid fa-users-gear text-[#1da1f2] text-xl mr-3"></i>
                    <div>
                        <h2 class="font-bold text-lg text-[#14171a] leading-tight">
                            {{ __('Directorio de Usuarios') }}
                        </h2>
                        <p class="text-xs text-[#657786] font-medium uppercase tracking-tighter">
                            {{ __('Gestión de cuentas y permisos de IT-TALK') }}
                        </p>
                    </div>
                </div>
                
                
                <div class="bg-[#f5f8fa] border border-[#e1e8ed] px-3 py-1 rounded-full">
                    <span class="text-xs font-bold text-[#657786]">
                        {{ $users->total() }} {{ __('registros') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white border-x border-b border-[#e1e8ed] rounded-b-xl overflow-hidden shadow-none">
            <x-table 
                :datos="$users" 
                solo="id,name,email,created_at" 
                prefijo="profile"
            />
        </div>

        
        <div class="py-6"></div>
    </div>
</x-app-layout>
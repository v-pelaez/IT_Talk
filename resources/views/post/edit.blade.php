<x-app-layout>
    <x-slot name="header">
        {{ __('Editar Post') }}
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white border-x border-t border-[#e1e8ed] p-4 rounded-t-xl">
            <div class="flex items-center text-[#1da1f2] mb-1">
                <i class="fas fa-pencil-alt mr-2 text-sm"></i>
                <span class="text-xs font-black uppercase tracking-widest">{{ __('Modificar Publicación') }}</span>
            </div>
            <h2 class="font-bold text-xl text-[#14171a] leading-tight">
                {{ __('¿Qué quieres cambiar, :name?', ['name' => auth()->user()->name]) }}
            </h2>
        </div>

        <div class="bg-white border border-[#e1e8ed] rounded-b-xl overflow-hidden shadow-none">
            
            <x-dynamic-form 
                :modelo="$post" 
                :accion="route('post.update', $post)" 
                :metodo="'PATCH'" 
                :excepto="['user_id', 'active']"
                submitText="Actualizar Post"
                class="border-none shadow-none" 
            />
        </div>

    </div>
</x-app-layout>
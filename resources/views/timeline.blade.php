<x-app-layout>
    <x-slot name="header">
        {{ __('Inicio') }}
    </x-slot>

    <div class="max-w-2xl mx-auto">
        {{-- 1. Caja para crear nuevo post --}}
        @auth
            @role('admin|moderator|user')
            <div class="bg-white border border-[#e1e8ed] rounded-t-xl p-4 shadow-none">
                <div class="flex items-center space-x-2 mb-3 ml-1">
                    <i class="fa-solid fa-terminal text-[#1da1f2] text-xs"></i>
                    <span class="text-xs font-black text-[#1da1f2] uppercase tracking-widest">Nueva Entrada</span>
                </div>
                
                <x-dynamic-form 
                    :modelo="new \App\Models\Post" 
                    :accion="route('posts.store')" 
                    solo="content"
                    submitText="Publicar"
                    class="border-none shadow-none p-0 bg-transparent"
                />
            </div>
            @endrole
        @endauth

        
        <div class="bg-white border-x border-b border-[#e1e8ed] rounded-b-xl overflow-hidden divide-y divide-[#e1e8ed]">
            @forelse ($posts as $post)
                
                <div class="hover:bg-[#f5f8fa] transition duration-200">
                    <x-post :post="$post" />
                </div>
            @empty
                <div class="py-20 text-center">
                    <i class="fa-solid fa-bug text-[#ccd6dd] text-5xl mb-4"></i>
                    <p class="text-[#657786] font-medium italic">
                        {{ __('No hay publicaciones todavía en IT-TALK.') }}
                    </p>
                </div>
            @endforelse
        </div>

        @if ($posts->hasPages())
            <div class="mt-6 px-2 pb-12">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
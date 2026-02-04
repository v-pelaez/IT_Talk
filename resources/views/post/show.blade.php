<x-app-layout>
    <x-slot name="header">
        {{ __('Post de :name', ['name' => $post->user?->name]) }}
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white border-x border-t border-[#e1e8ed] rounded-t-xl overflow-hidden">
            <x-postShow :post="$post" />
        </div>

        @auth
            <div class="bg-[#f5f8fa] border-x border-b border-[#e1e8ed] p-4 rounded-b-xl">
                <div class="flex items-center space-x-2 mb-2 ml-1">
                    <i class="fas fa-reply text-[#657786] text-xs"></i>
                    <span class="text-xs font-bold text-[#657786]">
                        En respuesta a <span class="text-[#1da1f2]"> {{ $post->user?->name }}</span>
                    </span>
                </div>

                <x-dynamic-form :modelo="new \App\Models\Comment()" :accion="route('comments.store')" solo="content" submitText="Responder" :ocultos="['post_id' => $post->id, 'active' => 1]"
                    class="border-none shadow-none p-0 bg-transparent space-y-3" />
            </div>
        @endauth

    </div>
</x-app-layout>

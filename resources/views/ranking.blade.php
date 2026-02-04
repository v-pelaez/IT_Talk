<x-app-layout>
    <x-slot name="header">
        {{ __('Ranking de Influencers') }}
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white border border-[#e1e8ed] rounded-t-xl p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16  mb-4">
                <i class="fa-solid fa-award text-[#1da1f2] text-3xl"></i>
            </div>
            <h2 class="font-black text-2xl text-[#14171a] tracking-tight">Top Influencers</h2>
            <p class="text-xs text-[#657786] font-bold uppercase tracking-widest mt-1">
                {{ __('Basado en el total de likes recibidos') }}
            </p>
        </div>

        <div class="bg-white border-x border-b border-[#e1e8ed]  overflow-hidden shadow-none divide-y divide-[#e1e8ed]">
            @forelse ($users as $index => $user)
                <div class="flex items-center justify-between p-4 hover:bg-[#f5f8fa] transition duration-150">
                    <div class="flex items-center space-x-4">
                        <span class="text-lg font-black text-[#1da1f2]  w-8">
                            #{{ $index + 1 }}
                        </span>
                        
                        <div>
                            <h4 class="font-black text-[#14171a] leading-none">{{ $user->name }}</h4>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2  px-3 py-1">
                        <i class="fa-solid fa-heart text-[#e0245e] text-xs"></i>
                        <span class="font-black text-sm text-[#14171a]">{{ $user->total_likes }}</span>
                    </div>
                </div>
            @empty
                <p class="p-8 text-center text-[#657786] font-medium italic">
                    {{ __('Aún no hay interacciones registradas.') }}
                </p>
            @endforelse
        </div>

        
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-12 bg-[#f5f8fa] min-h-screen"> 
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white border-x border-t border-[#e1e8ed] p-4 rounded-t-lg">
                <h2 class="font-bold text-lg text-[#14171a] leading-tight">
                    {{ __('Editar Comentario') }}
                </h2>
            </div>

            <div class="bg-white border border-[#e1e8ed] shadow-none p-6 rounded-b-lg">
                <form method="POST" action="{{ route('comment.update', $comment) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <span class="block text-xs font-bold text-[#657786] uppercase tracking-wide mb-2">
                            Comentario original
                        </span>
                        <div class="p-3 bg-[#f5f8fa] border border-[#e1e8ed] rounded-lg italic text-[#657786] text-sm">
                            "{{ $comment->content }}"
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-xs font-bold text-[#1da1f2] uppercase tracking-wide mb-1">
                            Nueva versión
                        </label>
                        <textarea 
                            name="content" 
                            id="content" 
                            rows="4" 
                            class="mt-1 block w-full border-[#ccd6dd] focus:border-[#1da1f2] focus:ring-1 focus:ring-[#1da1f2] rounded-lg bg-white text-[#14171a] transition"
                            required>{{ old('content', $comment->content) }}</textarea>

                        @error('content')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-[#e1e8ed] pt-4">
                        <a href="{{ route('timeline') }}" 
                           class="text-sm font-bold text-[#657786] hover:text-[#14171a] transition">
                            {{ __('Cancelar') }}
                        </a>

                        <button type="submit" 
                                class="inline-flex items-center px-5 py-2 bg-[#1da1f2] border border-transparent rounded-full font-bold text-sm text-white hover:bg-[#1991db] focus:outline-none focus:ring-2 focus:ring-[#1da1f2] transition ease-in-out duration-150 shadow-sm">
                            {{ __('Actualizar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
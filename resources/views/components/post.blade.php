@props(['post'])

<div class="max-w-2xl mx-auto bg-white border border-[#e1e8ed] mb-0 hover:bg-[#f5f8fa] transition duration-300 ease-in-out">
    <div class="p-4 flex">
        <div class="flex-shrink-0 mr-3">
            <div class="h-12 w-12 rounded-full bg-[#74bdcb] flex items-center justify-center text-white font-bold shadow-inner">
                {{ substr($post->user?->name ?? 'U', 0, 1) }}
            </div>
        </div>

        <div class="flex-1">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-1">
                    <span class="font-bold text-[#14171a] hover:underline cursor-pointer">
                        {{ $post->user?->name ?? __('Usuario eliminado') }}
                    </span>
                    <span class="text-[#657786] text-sm">·</span>
                    <span class="text-[#657786] text-sm hover:underline cursor-pointer">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>

                @auth
                    @if (auth()->id() === $post->user_id || auth()->user()->hasRole('admin'))
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('post.edit', $post) }}" class="text-[#1da1f2] hover:text-[#1991db] text-xs font-semibold uppercase tracking-tighter">
                                <i class="fas fa-pencil-alt mr-1"></i>Editar
                            </a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#657786] hover:text-red-600 text-xs">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="mt-2 text-[#14171a] text-[15px] leading-normal break-words">
                {!! nl2br(e(Str::limit($post->content, 150))) !!}
                
                @if(strlen($post->content) > 150)
                    <a class="text-[#1da1f2] font-semibold hover:underline ml-1" href="{{ route('post', $post->id) }}">Ver más</a>
                @endif
            </div>

            <div class="mt-4 flex items-center justify-between text-[#657786]">
                <div class="flex items-center space-x-12">
                    <a href="{{ route('post', $post->id) }}" class="group flex items-center space-x-2 hover:text-[#1da1f2]">
                        <div class="p-2 group-hover:bg-[#e1f5fe] rounded-full transition">
                            <i class="far fa-comment text-lg"></i>
                        </div>
                        <span class="text-xs">{{ $post->comments->count() }}</span>
                    </a>

                    <form action="{{ route('post.like', $post->id) }}" method="POST" class="flex items-center">
                        @csrf
                        <button type="submit" class="group flex items-center space-x-2 {{ $post->likes()->where('user_id', auth()->id())->exists() ? 'text-[#1da1f2]' : 'hover:text-[#1da1f2]' }}">
                            <div class="p-2 group-hover:bg-[#e1f5fe] rounded-full transition">
                                <i class="{{ $post->likes()->where('user_id', auth()->id())->exists() ? 'fas' : 'far' }} fa-heart text-lg"></i>
                            </div>
                            @if ($post->likes->count() > 0)
                                <span class="text-xs font-bold">{{ $post->likes->count() }}</span>
                            @endif
                        </button>
                    </form>
                </div>

                <span class="text-[10px] uppercase tracking-wider text-gray-400">
                    {{ $post->created_at->format('d M. y') }}
                </span>
            </div>
        </div>
    </div>
</div>
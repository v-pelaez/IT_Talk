@props(['post'])

<div
    class="max-w-2xl mx-auto bg-white rounded-none border border-[#e1e8ed] mb-0 hover:bg-[#f5f8fa] transition duration-300 ease-in-out">
    <div class="p-4 flex">
        <div class="flex-shrink-0 mr-3">
            <div
                class="h-12 w-12 rounded-full bg-[#74bdcb] flex items-center justify-center text-white font-bold shadow-inner">
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
                            <a href="{{ route('post.edit', $post) }}"
                                class="text-[#1da1f2] hover:text-[#1991db] text-xs font-semibold">
                                <i class="fas fa-pencil-alt mr-1"></i>Editar
                            </a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro?')">
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
                {!! nl2br(str($post->content, 150)) !!}
            </div>

            <div class="mt-4 flex items-center space-x-12 text-[#657786]">
                <button class="flex items-center space-x-2 group hover:text-[#1da1f2]">
                    <div class="p-2 group-hover:bg-[#e1f5fe] rounded-full transition">
                        <i class="far fa-comment text-lg"></i>
                    </div>
                    <span class="text-xs">{{ $post->comments->count() }}</span>
                </button>

                <form action="{{ route('post.like', $post->id) }}" method="POST" class="flex items-center">
                    @csrf
                    <button type="submit"
                        class="group flex items-center space-x-2 {{ $post->likes()->where('user_id', auth()->id())->exists()? 'text-[#1da1f2]': 'hover:text-[#1da1f2]' }}">
                        <div class="p-2 group-hover:bg-[#e1f5fe] rounded-full transition">
                            <i
                                class="{{ $post->likes()->where('user_id', auth()->id())->exists()? 'fas': 'far' }} fa-heart text-lg"></i>
                        </div>
                        @if ($post->likes->count() > 0)
                            <span class="text-xs font-bold">{{ $post->likes->count() }}</span>
                        @endif
                    </button>
                </form>

                <span class="text-[10px] uppercase tracking-wider text-gray-400">
                    {{ $post->created_at->format('d M. y') }}
                </span>
            </div>
        </div>
    </div>

    <div class="bg-[#f5f8fa] border-t border-[#e1e8ed]">
        @foreach ($post->comments as $comment)
            <div class="p-4 flex border-b border-[#e1e8ed] last:border-b-0 ml-12">
                <div class="flex-shrink-0 mr-3">
                    <div class="h-8 w-8 rounded-full bg-[#ccd6dd] flex items-center justify-center text-white text-xs">
                        {{ substr($comment->user?->name ?? 'U', 0, 1) }}
                    </div>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-1">
                            <span class="font-bold text-sm text-[#14171a]">
                                {{ $comment->user?->name ?? __('Usuario') }}
                            </span>

                            <span class="text-[#657786] text-xs">
                                · {{ $comment->created_at->diffForHumans() }}
                            </span>

                            @if ($comment->updated_at->gt($comment->created_at))
                                <span class="text-[#657786] text-[10px] italic">
                                    · {{ __('Editado') }} {{ $comment->updated_at->diffForHumans() }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-sm text-[#14171a] mt-1">
                        {!! nl2br(e($comment->content)) !!}
                    </div>

                    <div class="flex items-center mt-2 space-x-4">
                        <form action="{{ route('comment.like', $comment->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-xs {{ $comment->likes()->where('user_id', auth()->id())->exists()? 'text-[#1da1f2]': 'text-[#657786] hover:text-[#1da1f2]' }}">
                                <i class="fas fa-heart mr-1"></i>{{ $comment->likes->count() ?: '' }}
                            </button>
                        </form>

                        @auth
                            @if (auth()->id() === $comment->user_id || auth()->user()->can(['edit.comments', 'delete.comments']))
                                <a href="{{ route('comment.edit', $comment) }}"
                                    class="text-[#657786] hover:text-[#1da1f2] text-[10px] font-bold uppercase">Editar</a>
                                <form action="{{ route('comment.destroy', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-[#657786] hover:text-red-500 text-[10px] font-bold uppercase"
                                        onclick="return confirm('¿Seguro?')">Borrar</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

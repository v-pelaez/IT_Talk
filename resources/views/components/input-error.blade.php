@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-[11px] font-bold text-red-500 space-y-1 ms-1 mt-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center">
                <i class="fa-solid fa-circle-exclamation mr-1.5 text-[10px]"></i>
                <span class="italic leading-tight">{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif

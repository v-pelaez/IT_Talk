@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 pt-1 border-b-2 border-[#1da1f2] text-sm font-bold leading-5 text-[#14171a] focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-4 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 text-[#657786] hover:text-[#1da1f2] hover:bg-[#f5f8fa] hover:border-[#e1e8ed] focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#1da1f2] text-start text-base font-black text-[#1da1f2] bg-[#f5f8fa] focus:outline-none transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-bold text-[#657786] hover:text-[#1da1f2] hover:bg-[#f5f8fa] hover:border-[#ccd6dd] focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
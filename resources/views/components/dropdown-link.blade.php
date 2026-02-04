<a
    {{ $attributes->merge([
        'class' =>
            'block w-full px-4 py-2 text-start text-sm font-bold leading-5 text-[#657786] hover:text-[#1da1f2] hover:bg-[#f5f8fa] focus:outline-none focus:bg-[#f5f8fa] transition duration-150 ease-in-out',
    ]) }}>
    {{ $slot }}
</a>

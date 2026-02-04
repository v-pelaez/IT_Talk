@props(['type' => 'button'])

<button
    {{ $attributes->merge([
        'type' => $type,
        'class' => 'inline-flex items-center px-6 py-2 bg-[#f5f8fa] border border-[#e1e8ed] rounded-full font-bold text-xs text-[#657786] uppercase tracking-widest shadow-none hover:bg-[#e1e8ed] hover:text-[#14171a] focus:outline-none focus:ring-2 focus:ring-[#ccd6dd] focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150',
    ]) }}>
    {{ $slot }}
</button>
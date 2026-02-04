<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'inline-flex items-center px-6 py-2 bg-[#1da1f2] border border-transparent rounded-full font-bold text-sm text-white uppercase tracking-normal hover:bg-[#1991db] active:bg-[#1da1f2] focus:outline-none focus:ring-2 focus:ring-[#1da1f2] focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm'
]) }}>
    {{ $slot }}
</button>
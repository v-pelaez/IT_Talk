@props(['disabled' => false, 'value' => ''])

<input @disabled($disabled) value="{{ $value }}"
    {{ $attributes->merge([
        'class' =>
            'mt-1 block w-full border-[#ccd6dd] focus:border-[#1da1f2] focus:ring-1 focus:ring-[#1da1f2] rounded-lg bg-[#f5f8fa] text-[#14171a] shadow-none transition duration-200 placeholder-[#657786]',
    ]) }}>

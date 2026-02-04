@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-bold text-[#657786] uppercase tracking-widest mb-1 ms-1']) }}>
    {{ $value ?? $slot }}
</label>
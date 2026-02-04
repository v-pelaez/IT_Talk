@props(['status'])

@if ($status)
    <div
        {{ $attributes->merge(['class' => 'flex items-center p-3 mb-4 text-sm font-bold text-[#1da1f2] bg-[#e1f5fe] border border-[#b3e5fc] rounded-lg animate-pulse']) }}>
        <i class="fa-solid fa-circle-check mr-2 text-base"></i>
        <span>{{ $status }}</span>
    </div>
@endif

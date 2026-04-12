@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#f9faf9] text-sm font-medium leading-5 text-[#f9faf9] focus:outline-none focus:border-[#f9faf9] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-[#f9faf9] hover:text-[#f9faf9] hover:border-[#f9faf9] focus:outline-none focus:text-[#f9faf9] focus:border-[#f9faf9] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

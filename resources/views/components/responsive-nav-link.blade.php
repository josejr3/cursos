@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-secondary text-start text-base font-semibold text-on-surface bg-surface-container-high focus:outline-none focus:text-on-surface focus:bg-surface-container-highest focus:border-secondary-fixed transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high hover:border-outline focus:outline-none focus:text-on-surface focus:bg-surface-container-high focus:border-outline transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

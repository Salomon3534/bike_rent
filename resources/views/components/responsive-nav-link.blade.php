@props(['active'])

@php
$classes = ($active ?? false)
            ? 'menu-link menu-link--active'
            : 'menu-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

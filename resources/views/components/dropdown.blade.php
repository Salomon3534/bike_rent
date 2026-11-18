@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'dropdown__content'])

@php
$alignmentClasses = match ($align) {
    'left' => 'dropdown__panel--left',
    'top' => 'dropdown__panel--top',
    default => 'dropdown__panel--right',
};

$width = match ($width) {
    '48' => 'dropdown__panel--w-48',
    default => $width,
};
@endphp

<div class="dropdown" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="dropdown-enter"
            x-transition:enter-start="dropdown-enter-start"
            x-transition:enter-end="dropdown-enter-end"
            x-transition:leave="dropdown-leave"
            x-transition:leave-start="dropdown-leave-start"
            x-transition:leave-end="dropdown-leave-end"
            class="dropdown__panel {{ $width }} {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="{{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>

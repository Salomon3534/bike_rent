@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'modal__panel--sm',
    'md' => 'modal__panel--md',
    'lg' => 'modal__panel--lg',
    'xl' => 'modal__panel--xl',
    '2xl' => 'modal__panel--2xl',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('body--no-scroll');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('body--no-scroll');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="modal"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="modal__backdrop"
        x-on:click="show = false"
        x-transition:enter="modal-fade-enter"
        x-transition:enter-start="modal-fade-enter-start"
        x-transition:enter-end="modal-fade-enter-end"
        x-transition:leave="modal-fade-leave"
        x-transition:leave-start="modal-fade-leave-start"
        x-transition:leave-end="modal-fade-leave-end"
    >
        <div class="modal__overlay"></div>
    </div>

    <div
        x-show="show"
        class="modal__panel {{ $maxWidth }}"
        x-transition:enter="modal-pop-enter"
        x-transition:enter-start="modal-pop-enter-start"
        x-transition:enter-end="modal-pop-enter-end"
        x-transition:leave="modal-pop-leave"
        x-transition:leave-start="modal-pop-leave-start"
        x-transition:leave-end="modal-pop-leave-end"
    >
        {{ $slot }}
    </div>
</div>

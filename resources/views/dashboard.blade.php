<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header__title">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page">
        <div class="container container--flush">
            <div class="card">
                <div class="card__body">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header__title">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="page">
        <div class="container container--flush profile">
            <div class="card card--section">
                <div class="profile__panel">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card card--section">
                <div class="profile__panel">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card card--section">
                <div class="profile__panel">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

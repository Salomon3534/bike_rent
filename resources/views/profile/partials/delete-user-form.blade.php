<section class="profile__panel--stacked">
    <header>
        <h2 class="profile__title">
            {{ __('Delete Account') }}
        </h2>

        <p class="profile__description">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="modal__content">
            @csrf
            @method('delete')

            <h2 class="modal__title">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="modal__text">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="modal__field">
                <x-input-label for="password" value="{{ __('Password') }}" class="form__label--hidden" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="form__input--narrow"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="modal__actions">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

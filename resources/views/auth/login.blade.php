<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="auth__status" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="form">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div>
            <label for="remember_me" class="form__check">
                <input id="remember_me" type="checkbox" class="form__checkbox" name="remember">
                <span class="form__check-text">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="form__actions">
            @if (Route::has('password.request'))
                <a class="link link--muted" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

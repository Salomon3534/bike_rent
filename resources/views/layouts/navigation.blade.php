<nav x-data="{ open: false }" class="navbar">
    <!-- Menú principal -->
    <div class="container">
        <div class="navbar__bar">
            <div class="navbar__start">
                <!-- Logo -->
                <div class="navbar__brand">
                    <a href="{{ route('bikes.index') }}">
                        <x-application-logo class="navbar__logo" />
                    </a>
                </div>

                <!-- Enlaces de navegación -->
                <div class="navbar__links">
                    <x-nav-link :href="route('bikes.index')" :active="request()->routeIs('bikes.*')">
                        Catálogo
                    </x-nav-link>

                    @auth
                        <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                            Mis reservas
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Usuario (logueado) o acceso (invitado) -->
            <div class="navbar__user">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="navbar__user-button">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="navbar__user-caret">
                                    <svg class="navbar__user-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Cerrar sesión -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="navbar__auth-link">
                        {{ __('Log in') }}
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="navbar__auth-link navbar__auth-link--spaced">
                            {{ __('Register') }}
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Hamburguesa -->
            <div class="navbar__toggle-wrapper">
                <button @click="open = ! open" class="navbar__toggle">
                    <svg class="navbar__toggle-icon" viewBox="0 0 24 24">
                        <path x-show="! open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú responsive -->
    <div :class="{'navbar__menu--open': open}" class="navbar__menu">
        <div class="navbar__menu-section">
            <x-responsive-nav-link :href="route('bikes.index')" :active="request()->routeIs('bikes.*')">
                Catálogo
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                    Mis reservas
                </x-responsive-nav-link>
            @endauth
        </div>

        <div class="navbar__menu-account">
            @auth
                <div class="navbar__menu-user">
                    <div class="navbar__menu-name">{{ Auth::user()->name }}</div>
                    <div class="navbar__menu-email">{{ Auth::user()->email }}</div>
                </div>

                <div class="navbar__menu-list navbar__menu-list--spaced">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Cerrar sesión -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="navbar__menu-list">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log in') }}
                    </x-responsive-nav-link>

                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
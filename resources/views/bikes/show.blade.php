<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header__title">
            {{ $bike->model }}
        </h2>
    </x-slot>

    <div class="page">
        <div class="container container--flush">
            <div class="card card--padded">
                <p>Serie: {{ $bike->serial_number }}</p>
                <p>Precio: {{ $bike->price_per_hour }} €/hora</p>
                <p>Estado: {{ $bike->status }}</p>

                <div class="card__actions">
                    @auth
                        <a href="{{ route('bookings.create', $bike) }}" class="link link--accent">
                            Reservar esta bicicleta
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="link link--accent">
                            Inicia sesión para reservar
                        </a>
                    @endauth

                    <a href="{{ route('bikes.index') }}" class="link">Volver al catálogo</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
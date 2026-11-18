<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header__title">
            Mis reservas
        </h2>
    </x-slot>

    <div class="page">
        <div class="container container--flush card-grid">
            @forelse ($bookings as $booking)
                <div class="card card--padded">
                    <h3 class="card__title">{{ $booking->bike->model }}</h3>
                    <p>Estado: {{ $booking->status }}</p>
                    <p>Inicio: {{ $booking->start_time }}</p>
                    <p>Fin: {{ $booking->end_time }}</p>
                    <p>Total: {{ $booking->total_cost }} €</p>
                    <a href="{{ route('bookings.show', $booking) }}" class="link link--accent card__link">
                        Ver detalle
                    </a>
                </div>
            @empty
                <p class="card-grid__empty">Todavía no tienes reservas.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
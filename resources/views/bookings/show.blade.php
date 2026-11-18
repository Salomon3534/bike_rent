<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header__title">
            Detalle de la reserva
        </h2>
    </x-slot>

    <div class="page">
        <div class="container container--flush">
            <div class="card card--padded">
                <p>Bicicleta: {{ $booking->bike->model }}</p>
                <p>Usuario: {{ $booking->user->name }}</p>
                <p>Inicio: {{ $booking->start_time }}</p>
                <p>Fin: {{ $booking->end_time }}</p>
                <p>Estado: {{ $booking->status }}</p>
                <p>Total: {{ $booking->total_cost }} €</p>

                <div class="card__actions">
                    @if ($booking->status === 'pending')
                        <form method="POST" action="{{ route('bookings.cancel', $booking) }}">
                            @csrf
                            @method('PATCH')
                            <x-danger-button>Cancelar reserva</x-danger-button>
                        </form>
                    @endif

                    <a href="{{ route('bookings.index') }}" class="link">Volver a mis reservas</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
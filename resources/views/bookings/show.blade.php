<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle de la reserva
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <p>Bicicleta: {{ $booking->bike->model }}</p>
                <p>Usuario: {{ $booking->user->name }}</p>
                <p>Inicio: {{ $booking->start_time }}</p>
                <p>Fin: {{ $booking->end_time }}</p>
                <p>Estado: {{ $booking->status }}</p>
                <p>Total: {{ $booking->total_cost }} €</p>

                <div class="mt-4 flex items-center gap-4">
                    @if ($booking->status === 'pending')
                        <form method="POST" action="{{ route('bookings.cancel', $booking) }}">
                            @csrf
                            @method('PATCH')
                            <x-danger-button>Cancelar reserva</x-danger-button>
                        </form>
                    @endif

                    <a href="{{ route('bookings.index') }}" class="underline">Volver a mis reservas</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
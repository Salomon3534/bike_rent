<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Mis reservas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($bookings as $booking)
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg">{{ $booking->bike->model }}</h3>
                    <p>Estado: {{ $booking->status }}</p>
                    <p>Inicio: {{ $booking->start_time }}</p>
                    <p>Fin: {{ $booking->end_time }}</p>
                    <p>Total: {{ $booking->total_cost }} €</p>
                    <a href="{{ route('bookings.show', $booking) }}" class="inline-block mt-3 text-indigo-600 dark:text-indigo-400 underline">
                        Ver detalle
                    </a>
                </div>
            @empty
                <p class="text-gray-700 dark:text-gray-300">Todavía no tienes reservas.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
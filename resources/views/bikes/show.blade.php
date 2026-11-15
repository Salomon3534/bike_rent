<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $bike->model }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <p>Serie: {{ $bike->serial_number }}</p>
                <p>Precio: {{ $bike->price_per_hour }} €/hora</p>
                <p>Estado: {{ $bike->status }}</p>

                <div class="mt-4 flex gap-4">
                    @auth
                        <a href="{{ route('bookings.create', $bike) }}" class="text-indigo-600 dark:text-indigo-400 underline">
                            Reservar esta bicicleta
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 underline">
                            Inicia sesión para reservar
                        </a>
                    @endauth

                    <a href="{{ route('bikes.index') }}" class="underline">Volver al catálogo</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
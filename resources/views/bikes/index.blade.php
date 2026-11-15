<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Catálogo de bicicletas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($bikes as $bike)
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg">{{ $bike->model }}</h3>
                    <p>Serie: {{ $bike->serial_number }}</p>
                    <p>Precio: {{ $bike->price_per_hour }} €/hora</p>
                    <p>Estado: {{ $bike->status }}</p>
                    <a href="{{ route('bikes.show', $bike) }}" class="inline-block mt-3 text-indigo-600 dark:text-indigo-400 underline">
                        Ver detalle
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
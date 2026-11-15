<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Reservar {{ $bike->model }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                @if ($errors->any())
                    <ul class="mb-4 text-sm text-red-600 dark:text-red-400 list-disc ps-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('bookings.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="bike_id" value="{{ $bike->id }}">

                    <div>
                        <x-input-label for="start_time" value="Inicio" />
                        <x-text-input id="start_time" name="start_time" type="datetime-local" class="block mt-1 w-full" :value="old('start_time')" required />
                    </div>

                    <div>
                        <x-input-label for="end_time" value="Fin" />
                        <x-text-input id="end_time" name="end_time" type="datetime-local" class="block mt-1 w-full" :value="old('end_time')" required />
                    </div>

                    <x-primary-button>Confirmar reserva</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
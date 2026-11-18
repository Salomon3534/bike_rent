<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header__title">
            Reservar {{ $bike->model }}
        </h2>
    </x-slot>

    <div class="page">
        <div class="container container--flush container--narrow">
            <div class="card card--padded">
                @if ($errors->any())
                    <ul class="form__errors">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('bookings.store') }}" class="form">
                    @csrf
                    <input type="hidden" name="bike_id" value="{{ $bike->id }}">

                    <div>
                        <x-input-label for="start_time" value="Inicio" />
                        <x-text-input id="start_time" name="start_time" type="datetime-local" :value="old('start_time')" required />
                    </div>

                    <div>
                        <x-input-label for="end_time" value="Fin" />
                        <x-text-input id="end_time" name="end_time" type="datetime-local" :value="old('end_time')" required />
                    </div>

                    <x-primary-button>Confirmar reserva</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
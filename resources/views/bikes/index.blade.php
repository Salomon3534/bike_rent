<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header__title">
            Catálogo de bicicletas
        </h2>
    </x-slot>

    <div class="page">
        <div class="container container--flush card-grid">
            @foreach ($bikes as $bike)
                <div class="card card--padded">
                    <h3 class="card__title">{{ $bike->model }}</h3>
                    <p>Serie: {{ $bike->serial_number }}</p>
                    <p>Precio: {{ $bike->price_per_hour }} €/hora</p>
                    <p>Estado: {{ $bike->status }}</p>
                    <a href="{{ route('bikes.show', $bike) }}" class="link link--accent card__link">
                        Ver detalle
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
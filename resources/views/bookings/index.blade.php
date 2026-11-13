<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis reservas</title>
</head>
<body>
    <h1>Mis reservas</h1>

    @foreach ($bookings as $booking)
        <div>
            <h2>{{ $booking->bike->model }}</h2>
            <p>Estado: {{ $booking->status }}</p>
            <p>Inicio: {{ $booking->start_time }}</p>
            <p>Fin: {{ $booking->end_time }}</p>
            <p>Total: {{ $booking->total_cost }} €</p>
            <a href="{{ route('bookings.show', $booking) }}">Ver detalle</a>
        </div>
    @endforeach
</body>
</html>

<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('bike')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function create(Bike $bike)
    {
        if ($bike->status !== 'available') {
            return redirect()->route('bikes.index')
                ->with('error', 'Esta bicicleta no se encuentra disponible para alquilar.');
        }

        return view('bookings.create', compact('bike'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bike_id' => 'required|exists:bikes,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
        ], [
            'bike_id.required' => 'Debes seleccionar una bicicleta.',
            'bike_id.exists' => 'La bicicleta seleccionada no existe.',
            'start_time.required' => 'Indica la fecha y hora de inicio.',
            'start_time.date' => 'La fecha de inicio no es válida.',
            'start_time.after_or_equal' => 'La fecha de inicio no puede estar en el pasado.',
            'end_time.required' => 'Indica la fecha y hora de devolución.',
            'end_time.date' => 'La fecha de devolución no es válida.',
            'end_time.after' => 'La devolución debe ser posterior al inicio.',
        ]);

        $bike = Bike::findOrFail($request->bike_id);

        if ($bike->status !== 'available') {
            return back()->withInput()
                ->withErrors(['bike_id' => 'La bicicleta seleccionada no está disponible.']);
        }

        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);

        // Hay solapamiento si otra reserva empieza antes de que acabe esta
        // y termina después de que empiece esta
        $hasOverlap = Booking::where('bike_id', $bike->id)
            ->whereIn('status', ['pending', 'active'])
            ->where('start_time', '<', $endTime)
            ->where('end_time', '>', $startTime)
            ->exists();

        if ($hasOverlap) {
            return back()->withInput()
                ->withErrors(['start_time' => 'La bicicleta ya está reservada en ese horario.']);
        }

        // Se cobra por horas completas, con un mínimo de 1 hora
        $hours = max(1, (int) ceil($startTime->diffInMinutes($endTime) / 60));
        $totalCost = round($hours * (float) $bike->price_per_hour, 2);

        Booking::create([
            'user_id' => Auth::id(),
            'bike_id' => $bike->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => 'pending',
            'total_cost' => $totalCost,
        ]);

        return redirect()->route('bookings.index')
            ->with('success', '¡Reserva realizada con éxito!');
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta reserva.');
        }

        $booking->load('bike');

        return view('bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para modificar esta reserva.');
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Solo es posible cancelar reservas en estado pendiente.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('bookings.index')
            ->with('success', 'La reserva ha sido cancelada correctamente.');
    }
}
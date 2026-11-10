<?php

namespace Database\Factories;

use App\Models\Bike;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-2 weeks', '+2 weeks');
        $durationHours = fake()->numberBetween(1, 12);
        $end = (clone $start)->modify("+{$durationHours} hours");
        $bike = Bike::query()->inRandomOrder()->first() ?? Bike::factory()->create();
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->create();

        $totalCost = $bike->price_per_hour * $durationHours;

        return [
            'user_id' => $user->id,
            'bike_id' => $bike->id,
            'start_time' => $start,
            'end_time' => $end,
            'status' => fake()->randomElement(['pending', 'active', 'completed', 'cancelled']),
            'total_cost' => round($totalCost, 2),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Bike;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bike>
 */
class BikeFactory extends Factory
{
    protected $model = Bike::class;

    public function definition(): array
    {
        return [
            'serial_number' => fake()->unique()->bothify('BIKE-####-??'),
            'model' => fake()->randomElement(['Urbana', 'Montaña', 'Eléctrica']),
            'price_per_hour' => fake()->randomFloat(2, 10, 80),
            'status' => fake()->randomElement(['available', 'maintenance', 'retired']),
        ];
    }
}

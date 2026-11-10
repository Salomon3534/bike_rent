<?php

namespace Database\Seeders;

use App\Models\Bike;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory(5)->create();
        Bike::factory(10)->create();
        Booking::factory(20)->create();
    }
}

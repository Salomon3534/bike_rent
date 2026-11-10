<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BikeBookingSchemaTest extends TestCase
{
    use RefreshDatabase;

    public function test_bike_and_booking_tables_exist_with_expected_columns(): void
    {
        $this->assertTrue(Schema::hasTable('bikes'));
        $this->assertTrue(Schema::hasTable('bookings'));

        $this->assertTrue(Schema::hasColumn('bikes', 'serial_number'));
        $this->assertTrue(Schema::hasColumn('bikes', 'model'));
        $this->assertTrue(Schema::hasColumn('bikes', 'price_per_hour'));
        $this->assertTrue(Schema::hasColumn('bikes', 'status'));

        $this->assertTrue(Schema::hasColumn('bookings', 'user_id'));
        $this->assertTrue(Schema::hasColumn('bookings', 'bike_id'));
        $this->assertTrue(Schema::hasColumn('bookings', 'start_time'));
        $this->assertTrue(Schema::hasColumn('bookings', 'end_time'));
        $this->assertTrue(Schema::hasColumn('bookings', 'status'));
        $this->assertTrue(Schema::hasColumn('bookings', 'total_cost'));
    }
}

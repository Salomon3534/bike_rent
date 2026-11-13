<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index()
    {
        $bikes = Bike::query()
            ->where('status', '!=', 'retired')
            ->orderBy('id')
            ->get();

        return view('bikes.index', compact('bikes'));
    }

    public function show(Bike $bike)
    {
        return view('bikes.show', compact('bike'));
    }
}
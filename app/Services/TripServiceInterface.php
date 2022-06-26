<?php

namespace App\Services;

use App\DTOs\TripDTO;
use Illuminate\Support\Collection;

interface TripServiceInterface
{
    public function getTrips(): Collection;
    public function createTrip(TripDTO $tripDTO): TripDTO;
}

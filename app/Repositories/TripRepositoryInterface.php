<?php

namespace App\Repositories;

use App\DTOs\TripDTO;
use App\Models\Trip;
use Illuminate\Support\Collection;

interface TripRepositoryInterface
{
    public function listAll(): Collection;
    public function create(TripDTO $tripDTO): Trip;
}

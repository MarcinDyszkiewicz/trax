<?php

namespace App\Repositories;

use App\DTOs\CarDTO;
use App\Models\Car;
use Illuminate\Support\Collection;

interface CarRepositoryInterface
{
    public function listAll(): Collection;
    public function find(int $id): Car;
    public function create(CarDTO $carDTO): Car;
    public function delete(Car $car): bool;
}

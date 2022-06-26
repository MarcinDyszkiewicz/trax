<?php

namespace App\Services;

use App\DTOs\CarDTO;
use Illuminate\Support\Collection;

interface CarServiceInterface
{
    public function getCars(): Collection;
    public function getCar(int $id): CarDTO;
    public function createCar(CarDTO $carDTO): CarDTO;
    public function deleteCar(int $id): bool;
}

<?php

namespace App\Repositories;

use App\DTOs\CarDTO;
use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;

class CarRepository
{
    /**
     * @return Collection<Car>
     */
    public function listAll(): Collection
    {
        return Car::query()->limit(50)->get();
    }

    /**
     * @param int $id
     * @return Car
     */
    public function find(int $id): Car
    {
        return Car::findOrFail($id);
    }

    /**
     * @param CarDTO $carDTO
     * @return Car
     */
    public function create(CarDTO $carDTO): Car
    {
        $car = new Car();
        $car->make = $carDTO->getMake();
        $car->model = $carDTO->getModel();
        $car->year = $carDTO->getYear();

        $car->save();

        return $car;
    }

    /**
     * @param Car $car
     * @return bool
     * @throws \Throwable
     */
    public function delete(Car $car): bool
    {
        return $car->deleteOrFail();
    }

}

<?php

namespace App\Services;

use App\DTOs\CarDTO;
use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Support\Collection;


class CarService
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return Collection<CarDTO>
     */
    public function getCars(): Collection
    {
        $cars = $this->carRepository->listAll();

        return $cars->map(function (Car $car) {
            return $this->mapCarModelToDTO($car);
        });
    }

    /**
     * @param int $id
     * @return CarDTO
     */
    public function getCar(int $id): CarDTO
    {
        $car = $this->carRepository->find($id);

        return $this->mapCarModelToDTO($car);
    }

    /**
     * @param CarDTO $carDTO
     * @return CarDTO
     */
    public function createCar(CarDTO $carDTO): CarDTO
    {
        $car = $this->carRepository->create($carDTO);

        return $this->mapCarModelToDTO($car);
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Throwable
     */
    public function deleteCar(int $id): bool
    {
        $car = $this->carRepository->find($id);

        return $this->carRepository->delete($car);
    }

    /**
     * @param Car $car
     * @return CarDTO
     */
    private function mapCarModelToDTO(Car $car): CarDTO
    {
        return new CarDTO(
            $car->id,
            $car->make,
            $car->model,
            $car->year,
        );
    }
}

<?php

namespace App\Repositories;

use App\DTOs\TripDTO;
use App\Models\Trip;
use Illuminate\Support\Collection;

class TripRepository implements TripRepositoryInterface
{
    private CarRepositoryInterface $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return Collection
     */
    public function listAll(): Collection
    {
        return Trip::query()->with('car')->limit(50)->get();
    }

    /**
     * @param TripDTO $tripDTO
     * @return Trip
     */
    public function create(TripDTO $tripDTO): Trip
    {
        $trip = new Trip();
        $trip->car_id = $tripDTO->getCarId();
        $trip->date = $tripDTO->getDate()?->toDateString();
        $trip->miles = round($tripDTO->getMiles(), 2);
        $trip->total = round($this->getTotalMiles($tripDTO), 2);

        $trip->save();

        return $trip;
    }

    private function getTotalMiles(TripDTO $tripDTO): float
    {
        $tripsSumMiles = $this->carRepository->find($tripDTO->getCarId())->trips_sum_miles ?? 0;

        return $tripsSumMiles + $tripDTO->getMiles();
    }
}

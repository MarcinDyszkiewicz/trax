<?php

namespace App\Services;

use App\DTOs\CarDTO;
use App\DTOs\TripDTO;
use App\Models\Trip;
use App\Repositories\TripRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class TripService implements TripServiceInterface
{
    private TripRepositoryInterface $tripRepository;

    public function __construct(TripRepositoryInterface $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    /**
     * @return Collection
     */
    public function getTrips(): Collection
    {
        $trips = $this->tripRepository->listAll();

        return $trips->map(function (Trip $trip) {
            return $this->mapTripModelToDTO($trip);
        });
    }

    /**
     * @param TripDTO $tripDTO
     * @return TripDTO
     */
    public function createTrip(TripDTO $tripDTO): TripDTO
    {
        $trip = $this->tripRepository->create($tripDTO);

        return $this->mapTripModelToDTO($trip);
    }

    /**
     * @param Trip $trip
     * @return TripDTO
     */
    private function mapTripModelToDTO(Trip $trip): TripDTO
    {
        $carDTO = null;
        if ($trip->car) {
            $carDTO = new CarDTO(
                $trip->car->id,
                $trip->car->make,
                $trip->car->model,
                $trip->car->year,
            );
        }

        return new TripDTO(
            $trip->id,
            New Carbon($trip->date),
            $trip->miles,
            $trip->total,
            $carDTO,
            $trip->car_id
        );
    }
}

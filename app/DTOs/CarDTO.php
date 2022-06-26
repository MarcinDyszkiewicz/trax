<?php

namespace App\DTOs;

final class CarDTO
{
    private ?int $id;
    private ?string $make;
    private ?string $model;
    private ?int $year;
    private ?int $tripsCount;
    private int|null|float $tripMiles;

    /**
     * @param int|null $id
     * @param string|null $make
     * @param string|null $model
     * @param int|null $year
     * @param int|null $tripsCount
     * @param float|null $tripMiles
     */
    public function __construct(
        ?int $id,
        ?string $make,
        ?string $model,
        ?int $year,
        ?int $tripsCount = 0,
        ?float $tripMiles = 0
    )
    {
        $this->id = $id;
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->tripsCount = $tripsCount;
        $this->tripMiles = $tripMiles;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getMake(): ?string
    {
        return $this->make;
    }

    /**
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->model;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @return int|null
     */
    public function getTripsCount(): ?int
    {
        return $this->tripsCount;
    }

    /**
     * @return float|int|null
     */
    public function getTripMiles(): float|int|null
    {
        return $this->tripMiles;
    }
}

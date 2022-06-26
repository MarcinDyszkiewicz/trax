<?php

namespace App\DTOs;

use Illuminate\Support\Carbon;

final class TripDTO
{
    private ?int $id;
    private ?Carbon $date;
    private ?float $miles;
    private ?float $total;
    private ?CarDTO $carDTO;
    private ?int $carId;

    public function __construct(?int $id, ?Carbon $date, ?float $miles, ?float $total, ?CarDTO $carDTO, ?int $carId)
    {
        $this->id = $id;
        $this->date = $date;
        $this->miles = $miles;
        $this->total = $total;
        $this->carDTO = $carDTO;
        $this->carId = $carId;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Carbon|null
     */
    public function getDate(): ?Carbon
    {
        return $this->date;
    }

    /**
     * @return float|null
     */
    public function getMiles(): ?float
    {
        return $this->miles;
    }

    /**
     * @return float|null
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * @return CarDTO|null
     */
    public function getCarDTO(): ?CarDTO
    {
        return $this->carDTO;
    }

    /**
     * @return int|null
     */
    public function getCarId(): ?int
    {
        return $this->carId;
    }


}

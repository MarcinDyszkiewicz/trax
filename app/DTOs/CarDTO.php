<?php

namespace App\DTOs;

final class CarDTO
{
    private ?int $id;
    private ?string $make;
    private ?string $model;
    private ?int $year;

    /**
     * @param int|null $id
     * @param string|null $make
     * @param string|null $model
     * @param int|null $year
     */
    public function __construct(?int $id, ?string $make, ?string $model, ?int $year)
    {
        $this->id = $id;
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
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
}

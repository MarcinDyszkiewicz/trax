<?php

namespace Tests\Unit\Services;

use App\DTOs\CarDTO;
use App\Models\Car;
use App\Repositories\CarRepository;
use App\Services\CarService;
use Tests\TestCase;

class CarServiceTest extends TestCase
{
    /**
     * @var CarService
     */
    private mixed $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = app(CarService::class);
    }

    public function testGetCars(): void
    {
        $count = 5;
        $cars = Car::factory($count)->make();
        $repositoryMock = \Mockery::mock(CarRepository::class);
        $repositoryMock->shouldReceive('listAll')->andReturn($cars);
        $this->app->instance(CarRepository::class, $repositoryMock);
        $this->service = app(CarService::class);

        $result = $this->service->getCars();

        $this->assertCount($count, $result);
    }

    public function testGetCar(): void
    {
        $car = Car::factory()->make(['id' => 1]);
        $repositoryMock = \Mockery::mock(CarRepository::class);
        $repositoryMock->shouldReceive('find')->andReturn($car);
        $this->app->instance(CarRepository::class, $repositoryMock);
        $this->service = app(CarService::class);

        $result = $this->service->getCar($car->id);

        $this->assertEquals(1, $result->getId());
    }

    public function testCreateCar(): void
    {
        $car = Car::factory()->make();
        $repositoryMock = \Mockery::mock(CarRepository::class);
        $repositoryMock->shouldReceive('create')->andReturn($car);
        $this->app->instance(CarRepository::class, $repositoryMock);
        $this->service = app(CarService::class);

        $result = $this->service->createCar(
            new CarDTO(
                null,
                'BMW',
                'M135i',
                2021
            )
        );

        $this->assertEquals($car->id, $result->getId());
        $this->assertEquals($car->make, $result->getMake());
        $this->assertEquals($car->model, $result->getModel());
        $this->assertEquals($car->year, $result->getYear());
        $this->assertEquals(null, $result->getTripsCount());
        $this->assertEquals(null, $result->getTripMiles());
    }

    public function testDeleteCar(): void
    {
        $car = Car::factory()->make(['id' => 1]);
        $repositoryMock = \Mockery::mock(CarRepository::class);
        $repositoryMock->shouldReceive('find')->andReturn($car);
        $repositoryMock->shouldReceive('delete')->andReturn(true);
        $this->app->instance(CarRepository::class, $repositoryMock);
        $this->service = app(CarService::class);

        $result = $this->service->deleteCar($car->id);

        $this->assertTrue($result);
    }
}

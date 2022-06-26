<?php

namespace Tests\Unit\Services;

use App\DTOs\TripDTO;
use App\Models\Car;
use App\Models\Trip;
use App\Repositories\TripRepository;
use App\Services\TripService;
use Carbon\Carbon;
use Tests\TestCase;

class TripServiceTest extends TestCase
{
    /**
     * @var TripService
     */
    private mixed $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = app(TripService::class);
    }

    public function testGetTrips(): void
    {
        $count = 5;
        $trips = Trip::factory($count)->make();
        $repositoryMock = \Mockery::mock(TripRepository::class);
        $repositoryMock->shouldReceive('listAll')->andReturn($trips);
        $this->app->instance(TripRepository::class, $repositoryMock);
        $this->service = app(TripService::class);

        $result = $this->service->getTrips();

        $this->assertCount($count, $result);
    }

    public function testCreateTrip(): void
    {
        $car = Car::factory()->make();
        $trip = Trip::factory()->make();
        $trip->car = $car;
        $repositoryMock = \Mockery::mock(TripRepository::class);
        $repositoryMock->shouldReceive('create')->andReturn($trip);
        $this->app->instance(TripRepository::class, $repositoryMock);
        $this->service = app(TripService::class);

        $result = $this->service->createTrip(
            new TripDTO(
                null,
                today(),
                10.4,
                null,
                null,
                1
            )
        );

        $this->assertEquals($trip->id, $result->getId());
        $this->assertEquals($trip->car_id, $result->getCarId());
        $this->assertEquals(new Carbon($trip->date), $result->getDate());
        $this->assertEquals($trip->miles, $result->getMiles());
        $this->assertEquals($trip->total, $result->getTotal());

        $this->assertEquals($car->id, $result->getCarDTO()->getId());
        $this->assertEquals($car->make, $result->getCarDTO()->getMake());
        $this->assertEquals($car->model, $result->getCarDTO()->getModel());
        $this->assertEquals($car->year, $result->getCarDTO()->getYear());
    }
}

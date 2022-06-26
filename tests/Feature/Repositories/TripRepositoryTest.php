<?php

namespace Tests\Feature\Repositories;

use App\DTOs\TripDTO;
use App\Models\Car;
use App\Models\Trip;
use App\Repositories\TripRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = app(TripRepository::class);
    }

    public function testListAllTrips(): void
    {
        $count = 5;
        $car = Car::factory()->create();
        Trip::factory($count)->create(['car_id' => $car->id]);

        $result = $this->repository->listAll();

        $this->assertCount($count, $result);
    }

    public function testCreateTrip(): void
    {
        $car = Car::factory()->create();
        Trip::factory()->create(['car_id' => $car->id, 'miles' => 10.1]);

        $result = $this->repository->create(
            new TripDTO(
                null,
                today(),
                20.3,
                null,
                null,
                $car->id
            )
        );

        $this->assertDatabaseCount(Trip::getModel()->getTable(), 2);
        $this->assertModelExists($result);
        $this->assertDatabaseHas(Trip::getModel()->getTable(), [
            'car_id' => $car->id,
            'date' => today(),
            'miles' => 20.3,
            'total' => 30.4,
        ]);
    }

}

<?php

namespace Tests\Feature\Repositories;

use App\DTOs\CarDTO;
use App\Models\Car;
use App\Models\Trip;
use App\Repositories\CarRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var CarRepository
     */
    private mixed $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = app(CarRepository::class);
    }

    public function testListAllCars(): void
    {
        $count = 5;
        Car::factory($count)->create();

        $result = $this->repository->listAll();

        $this->assertCount($count, $result);
    }

    public function testFindSingleCar(): void
    {
        $car = Car::factory()->create();
        Trip::factory()->create([
            'car_id' => $car->id,
            'miles' => 10.2,
        ]);
        Trip::factory()->create([
            'car_id' => $car->id,
            'miles' => 10.4,
        ]);

        $result = $this->repository->find($car->id);

        $this->assertInstanceOf(Car::class, $result);
        $this->assertEquals($car->id, $result->id);
        $this->assertEquals(2, $result->trips_count);
        $this->assertEquals(20.6, $result->trips_sum_miles);
    }

    public function testCreateCar(): void
    {
        $result = $this->repository->create(
            new CarDTO(
                null,
                'BMW',
                'M135i',
                2021
            )
        );

        $this->assertDatabaseCount(Car::getModel()->getTable(), 1);
        $this->assertModelExists($result);
        $this->assertDatabaseHas(Car::getModel()->getTable(), [
            'make' => 'BMW',
            'model' => 'M135i',
            'year' => 2021,
        ]);
    }

    public function testDeleteCar(): void
    {
        $car = Car::factory()->create();

        $result = $this->repository->delete($car);

        $this->assertDatabaseCount(Car::getModel()->getTable(), 0);
        $this->assertModelMissing($car);
        $this->assertTrue($result);
    }
}

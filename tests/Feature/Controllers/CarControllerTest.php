<?php

namespace Tests\Feature\Controllers;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: add passport auth
    }

    public function testIndexEndpoint(): void
    {
        $count = 5;
        Car::factory($count)->create();

        $response = $this->getJson(route('cars.index'));

        $response->assertOk();
        $response->assertJsonCount($count, 'data');
    }

    public function testShowEndpoint(): void
    {
        $car = Car::factory()->create();

        $response = $this->getJson(route('cars.show', [$car->id]));

        $response->assertOk();
        $response->assertJsonStructure(['data' => ['id', 'make', 'model', 'year']]);
        $response->assertJson(['data' => ['id' => $car->id]]);
    }

    public function testCreateEndpoint(): void
    {
        $response = $this->postJson(route('cars.store', [
            'make' => 'BMW',
            'model' => 'M135i',
            'year' => 2021,
        ]));

        $response->assertCreated();
        $this->assertDatabaseCount(Car::getModel()->getTable(), 1);
        $this->assertDatabaseHas(Car::getModel()->getTable(), [
            'make' => 'BMW',
            'model' => 'M135i',
            'year' => 2021,
        ]);
    }


    public function testDestroyEndpoint(): void
    {
        $car = Car::factory()->create();

        $response = $this->deleteJson(route('cars.destroy', [$car->id]));

        $response->assertOk();
        $this->assertDatabaseCount(Car::getModel()->getTable(), 0);
        $this->assertModelMissing($car);
    }
}

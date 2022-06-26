<?php

namespace Tests\Feature\Controllers;

use App\Models\Car;
use App\Models\Trip;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class TripControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Passport::actingAs(User::factory()->create());
    }

    public function testIndexEndpoint(): void
    {
        $count = 5;
        $car = Car::factory()->create();
        Trip::factory($count)->create(['car_id' => $car->id]);

        $response = $this->getJson(route('trips.index'));

        $response->assertOk();
        $response->assertJsonCount($count, 'data');
        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'date',
                    'miles',
                    'total',
                    'car' => [
                        'id',
                        'make',
                        'model',
                        'year',
                    ],
                ],
            ],
        ]);
    }

    public function testCreateEndpoint(): void
    {
        $car = Car::factory()->create();

        $response = $this->postJson(route('trips.store', [
            'date' => today()->toDateString(),
            'miles' => 20.4,
            'car_id' => $car->id,
        ]));

        $response->assertCreated();
        $this->assertDatabaseCount(Trip::getModel()->getTable(), 1);
        $this->assertDatabaseHas(Trip::getModel()->getTable(), [
            'car_id' => $car->id,
            'date' => today(),
            'miles' => 20.4,
            'total' => 20.4,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\DTOs\CarDTO;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarListResource;
use App\Http\Resources\CarSingleResource;
use App\Services\CarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class CarController extends Controller
{
    private CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        $carDTOs = $this->carService->getCars();

        return CarListResource::collection($carDTOs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarRequest $request
     * @return JsonResponse
     */
    public function store(CarRequest $request)
    {
        $this->carService->createCar(
            new CarDTO(
                null,
                $request->input('make'),
                $request->input('model'),
                $request->input('year')
            )
        );

        return response()->json(['message' => 'Car created'], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CarSingleResource
     */
    public function show(int $id): CarSingleResource
    {
        $carDTO = $this->carService->getCar($id);

        return new CarSingleResource($carDTO);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws \Throwable
     */
    public function destroy(int $id): JsonResponse
    {
        $this->carService->deleteCar($id);

        return response()->json(['message' => 'Car deleted'], Response::HTTP_CREATED);
    }
}

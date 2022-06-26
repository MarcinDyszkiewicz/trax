<?php

namespace App\Http\Controllers;

use App\DTOs\TripDTO;
use App\Http\Requests\TripRequest;
use App\Http\Resources\TripListResource;
use App\Services\TripServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    private TripServiceInterface $tripService;

    public function __construct(TripServiceInterface $tripService)
    {
        $this->tripService = $tripService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        $tripDTOs = $this->tripService->getTrips();

        return TripListResource::collection($tripDTOs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TripRequest $request
     * @return JsonResponse
     */
    public function store(TripRequest $request): JsonResponse
    {
        $this->tripService->createTrip(
            new TripDTO(
                null,
                New Carbon($request->input('date')),
                $request->input('miles'),
                null,
                null,
                $request->input('car_id'
                )
            )
        );

        return response()->json(['message' => 'Car created'], Response::HTTP_CREATED);
    }
}

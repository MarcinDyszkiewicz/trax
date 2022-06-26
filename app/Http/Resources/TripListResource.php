<?php

namespace App\Http\Resources;

use App\DTOs\TripDTO;
use Illuminate\Http\Resources\Json\JsonResource;

class TripListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var TripDTO $tripDTO */
        $tripDTO = $this->resource;

        $car = null;
        if ($tripDTO->getCarDTO()) {
            $car = new CarListResource($tripDTO->getCarDTO());
        }

        return [
            'id'  => $tripDTO->getId(),
            'date' => $tripDTO->getDate()?->format('m/d/Y'),
            'miles' => number_format($tripDTO->getMiles(), 1),
            'total' => number_format($tripDTO->getTotal(), 1),
            'car' => $car,
        ];
    }
}

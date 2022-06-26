<?php

namespace App\Http\Resources;

use App\DTOs\CarDTO;
use Illuminate\Http\Resources\Json\JsonResource;

class CarListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var CarDTO $carDTO */
        $carDTO = $this->resource;

        return [
            'id' => $carDTO->getId(),
            'make' => $carDTO->getMake(),
            'model' => $carDTO->getModel(),
            'year' => $carDTO->getYear(),
        ];
    }
}

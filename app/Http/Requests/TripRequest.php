<?php

namespace App\Http\Requests;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            // ISO 8601 string
            'car_id' => [
                'required',
                'integer',
                'exists:' . Car::class . ',id',
            ],
            'miles' => 'required|numeric',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreRiderLocationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can implement your authorization logic here
    }

    public function rules()
    {
        return [
            'rider_id' => 'required|', // Ensure the rider exists
            'lat' => 'required|numeric', // Validate latitude
            'long' => 'required|numeric', // Validate longitude
            'captured_at' => 'required', // Validate the timestamp
        ];
    }

    public function messages()
    {
        return [
            'rider_id.required' => 'Rider ID is required.',
            'lat.required' => 'Latitude is required.',
            'long.required' => 'Longitude is required.',
            'captured_at.required' => 'Capture time is required.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        // Return a JSON response with a 422 status code
        throw new ValidationException($validator, response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors' => $errors,
        ], 422));
    }
}

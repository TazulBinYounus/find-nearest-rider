<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRiderRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Change this based on your authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'servie_name' => 'required|string|max:255',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'service_name.required' => 'Service name is required.',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422));
    }
}

<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PlaceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:30',
            'description' => 'required|max:255',
            'city' => 'required',
            'tags' => 'required|regex:"^[a-zA-Z]+(,[a-zA-Z]+)*$"',
            'image' => ['nullable', 'file', 'image'],
        ];
    }

    public function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => "Validation errors",
            'data' => $validator->errors(),
        ]));
    }
}

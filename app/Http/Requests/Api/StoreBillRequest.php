<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'house_id' => 'required|exists:houses,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'currency' => 'required|string|size:3',
            'due_date' => 'required|date',
            'type' => 'required|string|in:rent,electricity,water,gas,phone,internet,other',
            'shared' => 'required|boolean',
        ];
    }
}

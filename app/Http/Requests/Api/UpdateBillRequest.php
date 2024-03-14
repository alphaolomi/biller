<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBillRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'amount' => 'sometimes|numeric',
            'due_date' => 'sometimes|date',
            'description' => 'sometimes|string',
            'shared' => 'sometimes|boolean',
            'type' => 'sometimes|string|in:rent,electricity,water,gas,phone,internet,other',
        ];
    }
}

<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttachmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // size, type,
        return [
            // 'file' => 'sometimes|file|size:2048|mimes:pdf,jpg,jpeg,png',
            'file' => 'sometimes|file',
        ];
    }
}

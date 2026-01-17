<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportSellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sellers' => [
                'required',
                'array',
                'min:1',
            ],
            'sellers.*.name' => [
                'required',
                'string',
                'max:255',
            ],
            'sellers.*.username' => [
                'required',
                'string',
                'max:200'
            ],
            'sellers.*.email' => [
                'required',
                'email',
            ],
            'sellers.*.phone' => [
                'required',
                'string'
            ],
            'sellers.*.lote_id' => [
                'required',
                'exists:lotes,id'
            ],
        ];
    }
}

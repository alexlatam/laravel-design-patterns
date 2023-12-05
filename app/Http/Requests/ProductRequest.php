<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => [
                'name' => 'required|string|max:255|min:10',
                'description' => 'required|string|max:255|min:10',
                'price' => 'required|numeric|between:0,9999.99',
            ],
            'PUT' => [
                'name' => 'nullable|string|max:255|min:10',
                'description' => 'nullable|string|max:255|min:10',
                'price' => 'nullable|numeric|between:0,9999.99',
            ],
            default => [],
        };
    }
}

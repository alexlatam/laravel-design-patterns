<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'payload.title' => 'required|string|min:10',
            'payload.content' => 'required|string|min:50',
        ];
    }
}

<?php

namespace Hex\Backoffice\Users\Infrastructure\Request;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ];
    }
}

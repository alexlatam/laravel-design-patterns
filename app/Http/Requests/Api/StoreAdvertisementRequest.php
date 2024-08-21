<?php

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;

final class StoreAdvertisementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|alpha:ascii|max:45',
            'description' => 'sometimes|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|string|in:'. StatusEnum::NEW->value.','.
                StatusEnum::USED->value.','. StatusEnum::RESTORED->value. ',' . StatusEnum::AS_NEW->value,
            'final_date' => 'required|date|after:today',
        ];
    }
}

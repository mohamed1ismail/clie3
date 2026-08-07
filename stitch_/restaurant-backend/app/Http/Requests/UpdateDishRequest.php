<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'       => ['sometimes', 'required', 'exists:categories,id'],
            'name'              => ['sometimes', 'required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255'],
            'description'       => ['nullable', 'string'],
            'price'             => ['sometimes', 'required', 'numeric', 'min:0'],
            'image'             => ['nullable', 'image', 'max:5120'],
            'is_available'      => ['nullable', 'boolean'],
            'is_featured'       => ['nullable', 'boolean'],
            'calories'          => ['nullable', 'integer', 'min:0'],
            'prep_time_minutes' => ['nullable', 'integer', 'min:0'],
            'ingredients'       => ['nullable', 'array'],
            // Pass 'sizes' to replace all sizes; omit to leave existing sizes unchanged
            'sizes'                    => ['nullable', 'array'],
            'sizes.*.size_name'        => ['required_with:sizes', 'string', 'max:100'],
            'sizes.*.price'            => ['required_with:sizes', 'numeric', 'min:0'],
            'sizes.*.is_default'       => ['nullable', 'boolean'],
        ];
    }
}

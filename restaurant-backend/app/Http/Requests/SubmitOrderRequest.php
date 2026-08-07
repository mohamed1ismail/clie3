<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'table_id'                      => ['nullable', 'exists:tables,id'],
            'customer_name'                 => ['nullable', 'string', 'max:255'],
            'customer_phone'                => ['nullable', 'string', 'max:50'],
            'notes'                         => ['nullable', 'string'],
            'items'                         => ['required', 'array', 'min:1'],
            'items.*.dish_id'               => ['required', 'exists:dishes,id'],
            'items.*.dish_size_id'          => ['nullable', 'exists:dish_sizes,id'],
            'items.*.quantity'              => ['required', 'integer', 'min:1'],
            'items.*.special_instructions'  => ['nullable', 'string'],
        ];
    }
}

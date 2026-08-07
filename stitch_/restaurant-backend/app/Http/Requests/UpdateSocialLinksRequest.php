<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialLinksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'links' => ['required', 'array', 'min:1'],
            'links.*.platform' => ['required', 'string', 'max:100'],
            'links.*.title' => ['required', 'string', 'max:255'],
            'links.*.url' => ['required', 'url'],
            'links.*.icon' => ['nullable', 'string', 'max:100'],
            'links.*.is_active' => ['nullable', 'boolean'],
            'links.*.sort_order' => ['nullable', 'integer'],
        ];
    }
}

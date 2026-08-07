<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tableId = $this->route('table');
        return [
            'table_number' => ['sometimes', 'required', 'string', 'max:50', 'unique:tables,table_number,' . $tableId],
            'capacity' => ['sometimes', 'required', 'integer', 'min:1'],
            'status' => ['sometimes', 'required', 'in:available,occupied,reserved'],
        ];
    }
}

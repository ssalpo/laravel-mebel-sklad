<?php

namespace App\Http\Requests;

use App\Models\NomenclatureOperation;
use Illuminate\Foundation\Http\FormRequest;

class NomenclatureOperationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|in:' . implode(',', array_keys(NomenclatureOperation::OPERATION_LABELS)),
            'nomenclature_id' => 'required|exists:nomenclatures,id',
            'quantity' => 'required|numeric|gt:0',
            'comment' => 'nullable|string'
        ];
    }
}

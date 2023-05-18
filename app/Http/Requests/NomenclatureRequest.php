<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NomenclatureRequest extends FormRequest
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
            'company_id' => 'required',
            'name' => 'required|min:2|max:255',
            'base_price' => 'required|regex:/^\d+(\.\d{1,3})?$/|gt:0',
            'price_for_sale' => 'required|regex:/^\d+(\.\d{1,3})?$/|gt:0',
            'unit_id' => 'required|exists:units,id'
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'company_id' => auth()->user()->company_id
        ]);
    }
}

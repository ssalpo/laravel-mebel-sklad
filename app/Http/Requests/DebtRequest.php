<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DebtRequest extends FormRequest
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
            'created_by' => 'required',
            'client_id' => 'required|exists:clients,id',
            'order_id' => 'nullable|exists:orders,id',
            'amount' => 'required|regex:/^\d+(\.\d{1,3})?$/',
            'comment' => 'nullable|string|min:1|max:300'
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'created_by' => auth()->id(),
            'company_id' => auth()->user()->company_id
        ]);
    }
}

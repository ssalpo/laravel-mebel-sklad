<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DebtPaymentRequest extends FormRequest
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
            'created_by' => 'required',
            'amount' => 'required|regex:/^\d+(\.\d{1,3})?$/',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'created_by' => auth()->id()
        ]);
    }
}

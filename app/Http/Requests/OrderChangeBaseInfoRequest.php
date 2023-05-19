<?php

namespace App\Http\Requests;

use App\Models\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class OrderChangeBaseInfoRequest extends FormRequest
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
            'region_id' => 'required|exists:regions,id',
            'address' => 'required|string|min:2|max:255',
            'client_name' => 'required|string|min:2|max:255',
            'phone_number' => 'required|string|min:2|max:255',
            'deposit_amount' => 'nullable|gt:0|regex:/^\d+(\.\d{1,3})?$/',
        ];
    }
}

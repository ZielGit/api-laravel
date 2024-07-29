<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'document_type' => ['required', 'in:0,1'],
            'document_number' => ['required', 'string', 'unique:customers,document_number'],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:customers,email'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
        ];
    }
}

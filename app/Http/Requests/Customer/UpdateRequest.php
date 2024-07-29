<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'document_type' => ['required', 'in:0,1'],
                'document_number' => ['required', 'string', 'unique:customers,document_number,' . $this->customer->id],
                'name' => ['required', 'string'],
                'last_name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'unique:customers,email,' . $this->customer->id],
                'phone' => ['nullable', 'string'],
                'address' => ['nullable', 'string'],
            ];
        } else { // PATH
            return [
                'document_type' => ['sometmes', 'required', 'in:0,1'],
                'document_number' => ['sometmes', 'required', 'string', 'unique:customers,document_number,' . $this->customer->id],
                'name' => ['sometmes', 'required', 'string'],
                'last_name' => ['sometmes', 'required', 'string'],
                'email' => ['sometmes', 'required', 'string', 'email', 'unique:customers,email,' . $this->customer->id],
                'phone' => ['sometmes', 'nullable', 'string'],
                'address' => ['sometmes', 'nullable', 'string'],
            ];
        }
    }
}

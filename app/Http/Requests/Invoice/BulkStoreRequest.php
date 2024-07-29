<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.customer_id' => ['required', 'integer'],
            '*.amount' => ['required', 'numeric'],
            '*.status' => ['required', 'in:B,P,V,b,p,v'],
            '*.billed_dated' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.paid_dated' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }
}

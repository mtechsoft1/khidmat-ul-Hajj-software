<?php

namespace App\Http\Requests;

use App\Models\Vendor;
use Illuminate\Foundation\Http\FormRequest;

class CreateVendorRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return Vendor::$rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'country_id.exists' => 'The selected country is invalid.',
        ];
    }
}

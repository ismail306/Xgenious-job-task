<?php

namespace App\Http\Requests;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('countries', 'name')->ignore($this->country), // Ensure uniqueness, ignoring the current country
            ],
            'status' => 'required|in:active,inactive', // Validate status as 'active' or 'inactive'
        ];
    }
}

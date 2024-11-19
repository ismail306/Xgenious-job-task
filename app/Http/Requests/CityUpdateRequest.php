<?php

namespace App\Http\Requests;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityUpdateRequest extends FormRequest
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
                Rule::unique('cities', 'name')->ignore($this->city),
            ],
            'state_id' => 'required|exists:states,id', 
            'country_id' => 'required|exists:countries,id', 
            'status' => 'required|in:active,inactive', 
        ];
    }
}

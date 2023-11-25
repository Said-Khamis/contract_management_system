<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Country;

class CreateCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        //return Country::$rules;
        return
        [
            //'name' => 'required|unique:countries,name|alpha:ascii',
            'name' => 'required|unique:countries,name|regex:/^[A-Za-z\s]+$/',
        'code' => 'required|unique:countries,code|alpha:ascii',
        'flexRadioDefault' => 'required'
    ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'flexRadioDefault.required' => 'Please select a value for at least one below.',
        ];
    }
}

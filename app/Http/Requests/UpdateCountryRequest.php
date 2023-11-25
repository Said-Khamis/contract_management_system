<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCountryRequest extends FormRequest
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
        $id = $this->route('country');
        return [
            //'name' => 'required|alpha:ascii|unique:countries,name,'. $id,
            'name' => [
                'required',
                Rule::unique('countries', 'name')->ignore($id),
                'regex:/^[A-Za-z\s]+$/',
            ],

            'code' =>
                [
                    'required',
                    Rule::unique('countries', 'code')->ignore($id),
                    'alpha:ascii',
                ]
             ];


    }
}

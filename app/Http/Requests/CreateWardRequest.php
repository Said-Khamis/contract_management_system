<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Ward;
use Illuminate\Validation\Rule;

class CreateWardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       // return Ward::$rules;
       return [
        'name' => [
            'required', 'regex:/^[a-zA-Z\s]+$/',
            Rule::unique('wards')->where(function ($query) {
                return $query->where('district_id', $this->input('district_id'));
            }),
        ],
        'district_id' => [
            'required',
            Rule::unique('wards')->where(function ($query) {
                return $query->where('name', $this->input('name'));
            }),
        ],
    ];
    }
}

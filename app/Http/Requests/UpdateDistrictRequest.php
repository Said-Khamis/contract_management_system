<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\District;
use Illuminate\Validation\Rule;

class UpdateDistrictRequest extends FormRequest
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
       // $rules = District::$rules;
        
       // return $rules;

       return [
        'name' => [
            'required', 'regex:/^[a-zA-Z\s]+$/',
            Rule::unique('districts')->where(function ($query) {
                return $query->where('region_id', $this->input('region_id'));
            }),
        ],
        'region_id' => [
            'required',
            Rule::unique('districts')->where(function ($query) {
                return $query->where('name', $this->input('name'));
            }),
        ],
    ];
    }
}

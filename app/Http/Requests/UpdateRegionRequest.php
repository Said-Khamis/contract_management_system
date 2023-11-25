<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Region;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateRegionRequest extends FormRequest
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
    public function rules()
    {
       return [
        'name' => [
            'required','regex:/^[a-zA-Z\s]+$/',
//            Rule::unique('regions')->where(function ($query) {
//                return $query->where('country_id', $this->input('country_id'));
//            }),
        ],
        'country_id' => [
            'required',
//            Rule::unique('regions')->where(function ($query) {
//                return $query->where('name', $this->input('name'));
//            }),
        ],
    ];
    }
}

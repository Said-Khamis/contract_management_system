<?php

namespace App\Http\Requests\API;

use App\Models\Sector;
use InfyOm\Generator\Request\APIRequest;

class UpdateContractSectorAPIRequest extends APIRequest
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
        $rules = Sector::$rules;

        return $rules;
    }
}

<?php

namespace App\Http\Requests\API;

use App\Models\EmployeeDepartment;
use InfyOm\Generator\Request\APIRequest;

class UpdateEmployeeDepartmentAPIRequest extends APIRequest
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
        $rules = EmployeeDepartment::$rules;
        
        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Institution;

class UpdateInstitutionRequest extends FormRequest
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
        $id = $this->route('institution');
        return [
              'name' => 'required|alpha:ascii|unique:institutions,name,'. $id,
              'abbreviation' => 'required|alpha:ascii|unique:institutions,abbreviation,'. $id,
             ];
    }
}

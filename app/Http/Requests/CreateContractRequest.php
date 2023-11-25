<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Contract;
use Illuminate\Validation\Rule;

class CreateContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
            'end_date' => [
                'nullable',
                'after:start_date',
                'different:start_date',
            ],
            'signed_at' => [
                'nullable',
                Rule::when(request('end_date'), ['before:end_date']),
                'different:end_date',
            ],
            'start_date' => 'nullable',
            'title' => 'required',
            'reference_no' => 'nullable',
            'duration' => 'nullable|int',
            'type' => 'required',
            'category_id' => 'nullable',
        ];
        //return Contract::$rules;
    }
}

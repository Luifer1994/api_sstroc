<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePerfilEmployee extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'employee_id'           => 'required|exists:employees,id',
            'city_id'               => 'required|exists:cities,id',
            'address'               => 'required',
            'housing_type_id'       => 'required|exists:housing_types,id',
            'contact_emergency'     => 'required',
            'kindred_id'            => 'required|exists:kindreds,id',
            'phone_contact'         => 'required',
            'education_level_id'    => 'required|exists:education_levels,id',
            'dependents'            => 'required',
            'number_of_children'    => 'required',
            'use_free_time'         => 'required',
            'position_id'           => 'required|exists:positions,id',
            'type_contract_id'      => 'required|exists:type_contracts,id',
            'contract_date'         => 'required|date',
            'average_income'        => 'required|numeric',
            'seniority_range'       => 'required',
            'social_security_id'    => 'required|exists:social_securities,id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}

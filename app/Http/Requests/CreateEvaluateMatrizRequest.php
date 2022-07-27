<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateEvaluateMatrizRequest extends FormRequest
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
            'matrix_risk_id'              => 'required|exists:matrix_risks,id|unique:evaluate_matrices',
            'deficiency_level'            => 'required|numeric',
            'exposition_level'            => 'required|numeric',
            'consequence_level'           => 'required|numeric',
            'number_exposed_plant'        => 'required|numeric',
            'number_exposed_visitor'      => 'required|numeric',
            'number_exposed_contrataing'  => 'required|numeric',

            'exist_legal_requirement'     => 'required|boolean',
            'detail_legal_requirement'    => 'required_if:exist_legal_requirement,==,true',
            'exist_new_control'           => 'required|in:SI,NO,NO APLICA',
            'detail_control'              => 'required_if:exist_new_control,==,"SI"',
            'control_type'                => 'required_if:exist_new_control,==,"SI"',
            'date_programing_control'     => 'required_if:exist_new_control,==,"SI"',
            'position_id'                 => 'required_if:exist_new_control,==,"SI"',
            //Por ahora null
            'tracing'                     => 'nullable',
            'date_tracing'                => 'date|required_if:tracing,!==,""',
            'state_compliance'            => 'nullable|in:CERRADO,EN PROCESO,NO APLICA,NO INICIADO',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateMatrixRiskRequest extends FormRequest
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
            'position_id'           => 'required|exists:positions,id',
            'item'                  => 'required|numeric',
            'process_id'            => 'required|exists:processes,id',
            'area_id'               => 'required|exists:areas,id',
            'task_id'               => 'required|exists:tasks,id',
            'clasification'         => 'required|in:RUTINARIO,NO RUTINARIO',
            'risk_id'               => 'required|exists:risks,id',
            'possible_effects'      => 'nullable',
            'consequence'           => 'nullable',
            'hours_exposition_day'  => 'required|string',
            'exists_control'        => 'required|in:0,1',
            'cotrol_descrption'     => 'required_if:exists_control,==,1',
            'control_done'          => 'required|in:FUENTE,INDIVIDUE,MEDIO'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}

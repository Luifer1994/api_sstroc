<?php

namespace App\Http\Requests;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
            'name'              => 'required',
            'last_name'         => 'required',
            'phone'             => 'required',
            'type_document_id'  => 'required|exists:type_documents,id',
            'document_number'   => 'required|max:12',
            'birth_date'        => 'required|date',
            'gender_id'         => 'required|exists:genders,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}

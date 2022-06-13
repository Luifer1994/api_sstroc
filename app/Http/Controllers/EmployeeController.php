<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\StorePerfilEmployee;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\Response;
use App\Models\PerfilSociodemographic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $users = Employee::select(
            'employees.*',
            'type_documents.name as document_type',
            'genders.name as gender',
        )
            ->withCount('questions')
            ->join('type_documents', 'type_documents.id', '=', 'employees.type_document_id')
            ->join('genders', 'genders.id', '=', 'employees.gender_id')
            ->orderBy('employees.id', 'DESC')
            ->paginate($limit);

        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $request["user_id"] = Auth::user()->id;
        $employee = Employee::create($request->all());
        if ($employee) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $employee,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar empleado',
                'data' => null,
            ], 400);
        }
    }

    public function store_perfil(StorePerfilEmployee $request)
    {
        $perfil = PerfilSociodemographic::where('employee_id', $request->employee_id)->first();
        if (!$perfil) {
            $perfil_store = PerfilSociodemographic::create($request->all());
        } else {
            $perfil_store = $perfil->fill($request->all())->save();
        }
        if ($perfil_store) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $perfil,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar perfil',
                'data' => null,
            ], 400);
        }
    }

    function toArrayFilter($model, array $filterArray)
    {
        return array_intersect_key($model->toArray(), array_flip($filterArray));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::select(
            'employees.*',
            'type_documents.name as document_type',
            'genders.name as gender'
        )

            ->where('employees.id', $id)
            ->withCount('users')
            ->with('perfil_sociodemographics')
            ->join('type_documents', 'type_documents.id', '=', 'employees.type_document_id')
            ->join('genders', 'genders.id', '=', 'employees.gender_id')
            ->first();
        if ($employee) {
            $employee_data = $employee->toArray();
            $employee_data["perfil_sociodemographics"] = [];
            foreach ($employee->perfil_sociodemographics as $perfil_sociodemographic) {
                $perfil_sociodemographic_data = self::toArrayFilter($perfil_sociodemographic, ['address', 'contact_emergency', 'phone_contact', 'dependents', 'number_of_children', 'use_free_time', 'contract_date', 'average_income', 'seniority_range']);
                $perfil_sociodemographic_data['city_name'] = $perfil_sociodemographic->city->name;
                $perfil_sociodemographic_data['education_level_name'] = $perfil_sociodemographic->education_level->name;
                $perfil_sociodemographic_data['housing_type_name'] = $perfil_sociodemographic->housing_type->name;
                $perfil_sociodemographic_data['kindred_name'] = $perfil_sociodemographic->kindred->name;
                $perfil_sociodemographic_data['marital_status_name'] = $perfil_sociodemographic->marital_status->name;
                $perfil_sociodemographic_data['position_name'] = $perfil_sociodemographic->position->name;
                $perfil_sociodemographic_data['social_security_name'] = $perfil_sociodemographic->social_security->name;
                $perfil_sociodemographic_data['type_contract_name'] = $perfil_sociodemographic->type_contract->name;
                $perfil_sociodemographic_data['arl_name'] = $perfil_sociodemographic->arl->name;
                $perfil_sociodemographic_data['pension_fund_name'] = $perfil_sociodemographic->pension_fund->name;
                $employee_data["perfil_sociodemographics"][]   = $perfil_sociodemographic_data;
            }
            $employee_data["survey"] = $this->get_employee_survey($employee);
            return response()->json([
                'res' => true,
                'data' => $employee_data
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Not found'
            ], 400);
        }
    }

    public function get_employee_survey(\App\Models\Employee $employee)
    {
        $questions = $employee->questions;
        $questions_data = [];
        foreach ($questions as $key => $question) {
            $question_data["question_title"] = $question->title;
            $question_data["question_response"] = !empty($question->pivot->response) ? $question->pivot->response :  Response::find($question->pivot->response_id)->text;
            $questions_data[] = $question_data;
        }
        return $questions_data;
    }


    public function show_perfil($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee_data = $employee->toArray();
            $employee_data["perfil_sociodemographics"] = $employee->perfil_sociodemographics;
            $employee_data["survey"] = $this->get_employee_survey($employee);
            return response()->json([
                'res' => true,
                'data' => $employee_data
            ]);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $rules = [
                'email'         => 'required|email|unique:employees,email,' . $employee->id . ',id',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            if ($employee->update($request->all())) {
                return response()->json([
                    'res' => true,
                    'message' => 'Actualizaci��n exitosa',
                    'data' => $employee
                ], 200);
            } else {
                return response()->json([
                    'res' => false,
                    'message' => 'Error al actualizar el empleado'
                ], 400);
            }
        } else {
            return response()->json([
                'res' => false,
                'message' => 'El empleadono existe'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            if ($employee->delete()) {
                return response()->json([
                    'res' => true,
                    'data' => null
                ], 200);
            } else {
                return response()->json([
                    'res' => false,
                    'message' => 'Error al borrar el empleado'
                ], 400);
            }
        } else {

            return response()->json([
                'res' => false,
                'message' => 'Not found'
            ], 200);
        }
    }

    public function findDocument(Request $request)
    {
        $rules = ['document_number' => 'required|exists:employees,document_number'];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $employee = Employee::where('document_number', $request->document_number)->first();




        if ($employee->register_identification_risk) {
            $dateOld  = $employee->register_identification_risk;
            $dateCurrent = Carbon::now();
            $dateDiff = $dateOld->diffInMonths($dateCurrent);
            if ($dateDiff <= 6) {
                return response()->json([
                    'res' => true,
                    'message' => 'Ya contestaste esta encuesta hace menos de 6 meses.'
                ], 400);
            }
        }

        return response()->json([
            'res' => true,
            'data' => $employee
        ], 200);
    }
}

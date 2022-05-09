<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\StorePerfilEmployee;
use App\Models\Employee;
use App\Models\PerfilSociodemographic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //$users = Employee::with('gender', 'type_document')->get();
        $users = Employee::select(
            'employees.*',
            'type_documents.name as document_type',
            'genders.name as gender',
        )
            //->with('perfil_sociodemographics')
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
        $perfil = PerfilSociodemographic::create($request->all());
        if ($perfil) {
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        $employee["perfil_sociodemographics"] = $employee->perfil_sociodemographics;
        return response()->json([
            'res' => true,
            'data' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}

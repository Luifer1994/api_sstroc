<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaritalStatusrequest;
use App\Models\MaritalStatus;
use Illuminate\Http\Request;

class MaritalStatuController extends Controller
{
    //list paginated MaritalStatus
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $MaritalStatus = MaritalStatus::select(
            'marital_status.*',
        )->where('marital_status.name', 'like', '%'.$request["search"].'%')
            ->orderBy('marital_status.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $MaritalStatus
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marital_status = MaritalStatus::all();
        return response()->json([
            'res'=>true,
            'data'=>$marital_status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMaritalStatusrequest $request)
    {
        $marital_status = MaritalStatus::create($request->all());
        if(!empty($marital_status)){
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $marital_status,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar el estado civil',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaritalStatu  $maritalStatu
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $marital_status = MaritalStatus::find($id);
        if(!empty($marital_status)){
            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $marital_status,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el estado civil',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaritalStatu  $maritalStatu
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMaritalStatusrequest $request, int $id)
    {
        $marital_status = MaritalStatus::find($id);
        if(!empty($marital_status)){
            $marital_status->update($request->all());
            return response()->json([
                'res' => true,
                'message' => 'Registro actualizado',
                'data' => $marital_status,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el estado civil',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaritalStatu  $maritalStatu
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $marital_status = MaritalStatus::find($id);
        if(!empty($marital_status)){
            $marital_status->delete();
            return response()->json([
                'res' => true,
                'message' => 'Registro eliminado',
                'data' => $marital_status,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el estado civil',
                'data' => null,
            ], 404);
        }
    }
}

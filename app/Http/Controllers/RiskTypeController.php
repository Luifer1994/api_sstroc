<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRiskTypeRequest;
use App\Models\RiskType;
use Illuminate\Http\Request;

class RiskTypeController extends Controller
{
    //list paginated risk types
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $RiskTypes = RiskType::select(
            'risk_types.*',
        )->where('risk_types.name', 'like', '%'.$request["search"].'%')
            ->orderBy('risk_types.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $RiskTypes
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riskTypes = RiskType::with('risks')->get();

        return response()->json(['res' => true, 'data' => $riskTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRiskTypeRequest $request)
    {
        $riskType = RiskType::create($request->all());
        if (!empty($riskType)) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $riskType,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar el tipo de riesgo',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiskType  $riskType
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $riskType = RiskType::with('risks')->find($id);
        if (!empty($riskType)) {
            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $riskType,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontró el tipo de riesgo',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiskType  $riskType
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRiskTypeRequest $request, int $id)
    {
        $riskType = RiskType::find($id);
        if (!empty($riskType)) {
            $riskType->update($request->all());
            return response()->json([
                'res' => true,
                'message' => 'Registro actualizado',
                'data' => $riskType,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontró el tipo de riesgo',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiskType  $riskType
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $riskType = RiskType::find($id);
        if (!empty($riskType)) {
            $riskType->delete();
            return response()->json([
                'res' => true,
                'message' => 'Registro eliminado',
                'data' => $riskType,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontró el tipo de riesgo',
                'data' => null,
            ], 404);
        }
    }
}

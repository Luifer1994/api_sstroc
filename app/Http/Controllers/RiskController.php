<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRiskRequest;
use App\Models\Risk;
use Illuminate\Http\Request;

class RiskController extends Controller
{

    //list paginated risk types
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $Risks = Risk::select(
            'risks.*',
        )->where('risks.name', 'like', '%'.$request["search"].'%')
        ->with('risk_type')
            ->orderBy('risks.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $Risks
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $risks = Risk::all();
        return response()->json([
            'res' => true,
            'data' => $risks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRiskRequest $request)
    {
        $risk = Risk::create($request->all());
        if (!empty($risk)) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $risk,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar el riesgo',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Risk  $risk
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $risk = Risk::find($id);
        if (!empty($risk)) {
            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $risk
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontró el riesgo',
                'data' => null
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Risk  $risk
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRiskRequest $request, int $id)
    {
        $risk = Risk::find($id);
        if (!empty($risk)) {
            $risk->update($request->all());
            return response()->json([
                'res' => true,
                'message' => 'Actualización exitosa',
                'data' => $risk
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontró el riesgo',
                'data' => null
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Risk  $risk
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $risk = Risk::find($id);
        if (!empty($risk)) {
            $risk->delete();
            return response()->json([
                'res' => true,
                'message' => 'Eliminación exitosa',
                'data' => null
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontró el riesgo',
                'data' => null
            ], 404);
        }
    }
}

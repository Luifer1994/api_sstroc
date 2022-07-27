<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMatrixRiskRequest;
use App\Models\MatrixRisk;
use Illuminate\Http\Request;

class MatrixRiskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;

        $matrix = MatrixRisk::select('*')
            ->with(['area:id,name', 'position:id,name', 'process:id,name', 'risk:id,name,risks_type_id', 'risk.risk_type:id,name', 'task:id,name'])
            ->withCount('evaluate_matrices')
            ->orderBy('id', 'DESC')
            ->paginate($limit);

        return response()->json([
            'res' => true,
            'data' => $matrix
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMatrixRiskRequest $request)
    {
        try {
            $newMatrixRiks = MatrixRisk::create($request->all());

            if (!$newMatrixRiks) {
                return response()->json([
                    'res' => false,
                    'message' => "Error al registrar datos"
                ], 400);
            }

            return response()->json([
                'res' => true,
                'message' => "Registro exitoso"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatrixRisk  $matrixRisk
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $matrixRisk = MatrixRisk::select('*')
            ->with(['area:id,name', 'position:id,name', 'process:id,name', 'risk:id,name,risks_type_id', 'risk.risk_type:id,name', 'task:id,name'])
            ->where('id', $id)
            ->first();

        if (!$matrixRisk) {
            return response()->json([
                'res' => false,
                'message' => 'El registro no existe'
            ], 404);
        }

        return response()->json([
            'res' => true,
            'data' => $matrixRisk
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MatrixRisk  $matrixRisk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MatrixRisk $matrixRisk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatrixRisk  $matrixRisk
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatrixRisk $matrixRisk)
    {
        //
    }
}

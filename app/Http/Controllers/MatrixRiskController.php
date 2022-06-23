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
    public function index()
    {
        //
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
    public function show(MatrixRisk $matrixRisk)
    {
        //
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

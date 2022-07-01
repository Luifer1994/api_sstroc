<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEvaluateMatrizRequest;
use App\Models\EvaluateMatrix;
use Illuminate\Http\Request;

class EvaluateMatrixController extends Controller
{
    public function store(CreateEvaluateMatrizRequest $request)
    {
        $request["probability_level"]   = $request["deficiency_level"] * $request["exposition_level"];
        $request["risk_level"]          = $request["probability_level"] * $request["consequence_level"];
        $request["total_exposed"]       = $request["number_exposed_plant"] + $request["number_exposed_visitor"] + $request["number_exposed_contrataing"];

        $evaluate = EvaluateMatrix::create($request->all());

        if ($evaluate) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $evaluate,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar evaluación',
                'data' => null,
            ], 400);
        }
    }
}

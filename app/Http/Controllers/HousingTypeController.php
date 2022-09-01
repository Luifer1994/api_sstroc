<?php

namespace App\Http\Controllers;

use App\Models\HousingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HousingTypeController extends Controller
{
    //lits all areas paginated
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $housingTypes = HousingType::select(
            'housing_types.*',
        )
            ->orderBy('housing_types.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $housingTypes
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $housing_types = HousingType::all();
        return response()->json([
            'res' => true,
            'data' => $housing_types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate name using the validator class
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $housing_type = HousingType::create($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Tipo de vivienda creada correctamente',
            'data' => $housing_type
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HousingType  $housingType
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $housing_type = HousingType::find($id);
        if (!$housing_type) {
            return response()->json([
                'res' => false,
                'message' => 'Tipo de vivienda no encontrada'
            ], 404);
        }
        return response()->json([
            'res' => true,
            'data' => $housing_type
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HousingType  $housingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //find by id and validate using the validator class and update
        $housing_type = HousingType::find($id);
        if (!$housing_type) {
            return response()->json([
                'res' => false,
                'message' => 'Tipo de vivienda no encontrada'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $housing_type->update($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Tipo de vivienda actualizada correctamente',
            'data' => $housing_type
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HousingType  $housingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $housing_type = HousingType::find($id);
        if (!$housing_type) {
            return response()->json([
                'res' => false,
                'message' => 'Tipo de vivienda no encontrada'
            ], 404);
        }
        $housing_type->delete();
        return response()->json([
            'res' => true,
            'message' => 'Tipo de vivienda eliminada correctamente'
        ]);
    }
}

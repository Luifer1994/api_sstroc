<?php

namespace App\Http\Controllers;

use App\Models\EducationLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducationLevelController extends Controller
{

    //lits all areas paginated
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $educationLevels = EducationLevel::select(
            'education_levels.*',
        )
            ->orderBy('education_levels.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $educationLevels
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $education_levels = EducationLevel::all();
        return response()->json([
            'res'=>true,
            'data'=>$education_levels
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
        $education_level = EducationLevel::create($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Nivel de educación creado correctamente',
            'data' => $education_level
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EducationLevel  $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $education_level = EducationLevel::find($id);
        if (!$education_level) {
            return response()->json([
                'res' => false,
                'message' => 'Nivel de educación no encontrado'
            ], 404);
        }
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $education_level
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EducationLevel  $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $education_level = EducationLevel::find($id);
        if (!$education_level) {
            return response()->json([
                'res' => false,
                'message' => 'Nivel de educación no encontrado'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $education_level->update($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Nivel de educación actualizado correctamente',
            'data' => $education_level
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EducationLevel  $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $education_level = EducationLevel::find($id);
        if (!$education_level) {
            return response()->json([
                'res' => false,
                'message' => 'Nivel de educación no encontrado'
            ], 404);
        }
        $education_level->delete();
        return response()->json([
            'res' => true,
            'message' => 'Nivel de educación eliminado correctamente'
        ]);
    }
}

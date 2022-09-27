<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGenderRequest;
use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{

    //lits all Genders paginated
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $gender = Gender::select(
            'genders.*',
        )
        ->where('genders.name', 'like', '%'.$request["search"].'%')
            ->orderBy('genders.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $gender
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genders = Gender::all();
        return response()->json([
            'res' => true,
            'data' => $genders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGenderRequest $request)
    {
        $gender = Gender::create($request->all());
        if (!empty($gender)) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $gender,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar el género',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $gender = Gender::find($id);
        if (!empty($gender)) {
            return response()->json([
                'res' => true,
                'data' => $gender
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
     * @param  \App\Models\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function update(CreateGenderRequest $request, int $id)
    {
        $gender = Gender::find($id);
        if ($gender) {
            if ($gender->fill($request->all())->save()) {
                return response()->json([
                    'res' => true,
                    'data' => $gender
                ]);
            } else {
                return response()->json([
                    'res' => false,
                    'message' => 'Error al registrar el pais',
                    'data' => null,
                ], 400);
            }
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Not found'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $gender = Gender::find($id);
        if (!$gender) {
            return response()->json([
                'res' => false,
                'message' => 'Género no encontrada'
            ], 404);
        }
        $gender->delete();
        return response()->json([
            'res' => true,
            'message' => 'Género eliminado correctamente'
        ]);
    }
}

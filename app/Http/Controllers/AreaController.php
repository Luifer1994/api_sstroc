<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    //lits all areas paginated
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $areas = Area::select(
            'areas.*',
        ) ->where('areas.name', 'like', '%'.$request["search"].'%')
            ->orderBy('areas.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $areas
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
        return response()->json([
            'res' => true,
            'data' => $areas
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
        $area = Area::create($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Area creada correctamente',
            'data' => $area
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $area = Area::find($id);
        if (!$area) {
            return response()->json([
                'res' => false,
                'message' => 'Area no encontrada'
            ], 404);
        }
        return response()->json([
            'res' => true,
            'data' => $area
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $area = Area::find($id);
        if (!$area) {
            return response()->json([
                'res' => false,
                'message' => 'Area no encontrada'
            ], 404);
        }
        //validate name using the validator class
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $area->update($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Area actualizada correctamente',
            'data' => $area
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $area = Area::find($id);
        if (!$area) {
            return response()->json([
                'res' => false,
                'message' => 'Area no encontrada'
            ], 404);
        }
        $area->delete();
        return response()->json([
            'res' => true,
            'message' => 'Area eliminada correctamente'
        ], 200);
    }

    public function topFindingForArea()
    {
        $data = Area::select('id', 'name')->whereHas('finding', function ($q) {
            $q->where('area_id', '>', 0);
        })
            ->withCount('finding')->orderBy('finding_count', 'DESC')->limit(10)->get();

        return response()->json([
            'res' => true,
            'data' => $data
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Arl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArlController extends Controller
{

    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $arls = Arl::select(
            'arls.*',
        )->where('arls.name', 'like', '%'.$request["search"].'%')
            ->orderBy('arls.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $arls
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arls = Arl::all();
        return response()->json([
            'res' => true,
            'data' => $arls
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

        $arl = Arl::create($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Arl creada correctamente',
            'data' => $arl
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arl  $arl
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $arl = Arl::find($id);
        if (!$arl) {
            return response()->json([
                'res' => false,
                'message' => 'Arl no encontrada'
            ], 404);
        }
        return response()->json([
            'res' => true,
            'data' => $arl
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Arl  $arl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $arl = Arl::find($id);
        if (!$arl) {
            return response()->json([
                'res' => false,
                'message' => 'Arl no encontrada',
            ], 404);
        }
        //update the name of the arl and validate name using the validator class
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $arl->update($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Arl actualizado correctamente',
            'data' => $arl
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arl  $arl
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $arl = Arl::find($id);
        if (!$arl) {
            return response()->json([
                'res' => false,
                'message' => 'Arl no encontrada',
            ], 404);
        }
        $arl->delete();
        return response()->json([
            'res' => true,
            'message' => 'Arl eliminado correctamente',
            'data' => $arl
        ]);
    }
}

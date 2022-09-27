<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKingdredRequest;
use App\Models\Kindred;
use Illuminate\Http\Request;

class KindredController extends Controller
{
    //list paginated kindreds
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $Kindred = Kindred::select(
            'kindreds.*',
        )->where('kindreds.name', 'like', '%'.$request["search"].'%')
            ->orderBy('kindreds.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $Kindred
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kindreds = Kindred::all();
        return response()->json([
            'res'=>true,
            'data'=>$kindreds
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateKingdredRequest $request)
    {
        $kindred = Kindred::create($request->all());
        if(!empty($kindred)){
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $kindred,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar la kindred',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kindred  $kindred
     * @return \Illuminate\Http\Response
     */
    public function show(int $int)
    {
        $kindred = Kindred::find($int);
        if(!empty($kindred)){
            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $kindred,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro la kindred',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kindred  $kindred
     * @return \Illuminate\Http\Response
     */
    public function update(CreateKingdredRequest $request, int $id)
    {
        $kingdred = Kindred::find($id);
        if($kingdred){
            if($kingdred->fill($request->all())->save()){
                return response()->json([
                    'res' => true,
                    'data' => $kingdred,
                    'message' => 'Actualización exitosa'
                ]);
            }else{
                return response()->json([
                    'res' => false,
                    'message' => 'Error al actualizar la kindred',
                    'data' => null,
                ], 400);
            }

        }else{
            return response()->json([
                'res' => false,
                'message' => 'Not found'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kindred  $kindred
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $int)
    {
        $kindred = Kindred::find($int);
        if($kindred){
            if($kindred->delete()){
                return response()->json([
                    'res' => true,
                    'message' => 'Kindred eliminada correctamente',
                    'data' => $kindred,
                ], 200);
            }else{
                return response()->json([
                    'res' => false,
                    'message' => 'Error al eliminar la kindred',
                    'data' => null,
                ], 400);
            }
        }else{
            return response()->json([
                'res' => false,
                'message' => 'Not found'
            ],404);
        }
    }
}

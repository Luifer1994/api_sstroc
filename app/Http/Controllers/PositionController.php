<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProccessToPositionRequest;
use App\Http\Requests\CreatePositionRequest;
use App\Models\Position;
use App\Models\PositionsProcess;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    //list paginated Position
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $Position = Position::select(
            'positions.*',
        )
        ->where('positions.name', 'like', '%'.$request["search"].'%')
            ->orderBy('positions.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $Position
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all();
        return response()->json([
            'res' => true,
            'data' => $positions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePositionRequest $request)
    {
        $position = Position::create($request->all());
        if (!empty($position)) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $position,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar el cargo',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $position = Position::find($id);
        if (!empty($position)) {
            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $position,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el cargo',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePositionRequest $request, int $id)
    {
        $position = Position::find($id);
        if (!empty($position)) {
            $position->update($request->all());
            return response()->json([
                'res' => true,
                'message' => 'Actualización exitosa',
                'data' => $position,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el cargo',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $position = Position::find($id);
        if (!empty($position)) {
            $position->delete();
            return response()->json([
                'res' => true,
                'message' => 'Eliminación exitosa',
                'data' => $position,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el cargo',
                'data' => null,
            ], 404);
        }
    }

    public function listProcessByPosition(int $id)
    {
        $data = Position::select('id','name')->with('processes:id,name')->where('id', $id)->first();

        return response()->json([
            'res' => true,
            'data' => $data
        ], 200);
    }

    /**
     * add several process to position
     *
     * @param  int  $position_id, array $processes
     * @return \Illuminate\Http\Response
     */
    public function addProcessToPosition(AddProccessToPositionRequest $request)
    {
        $position = Position::find($request->position_id);
        if (!empty($position)) {
            PositionsProcess::whereNotIn('process_id', $request->processes)
                ->where('position_id', $request->position_id)->delete();

            $position->processes()->syncWithoutDetaching($request->processes);
            return response()->json([
                'res' => true,
                'message' => 'Procesos agregados exitosamente',
                'data' => $position->proccesses,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el cargo',
                'data' => null,
            ], 404);
        }
    }
}

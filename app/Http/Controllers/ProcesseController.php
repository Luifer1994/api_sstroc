<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProccessRequest;
use App\Models\Process;
use App\Models\Processe;
use Illuminate\Http\Request;

class ProcesseController extends Controller
{

    //list paginated MaritalStatus
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $Process = Process::select(
            'processes.*',
        )->where('processes.name', 'like', '%'.$request["search"].'%')
            ->orderBy('processes.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $Process
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list all processe
        $processe = Process::all();
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $processe,
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProccessRequest $request)
    {
        $processe = Process::create($request->all());
        if (!empty($processe)) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $processe,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar el proceso',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Processe  $processe
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $processe = Process::find($id);
        if (!empty($processe)) {
            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $processe,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el proceso',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Processe  $processe
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProccessRequest $request, int $id)
    {
        $processe = Process::find($id);
        if (!empty($processe)) {
            $processe->update($request->all());
            return response()->json([
                'res' => true,
                'message' => 'Registro actualizado',
                'data' => $processe,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el proceso',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Processe  $processe
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $processe = Process::find($id);
        if (!empty($processe)) {
            $processe->delete();
            return response()->json([
                'res' => true,
                'message' => 'Registro eliminado',
                'data' => $processe,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el proceso',
                'data' => null,
            ], 404);
        }
    }
}

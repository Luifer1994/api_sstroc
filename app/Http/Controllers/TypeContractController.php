<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTypeContracRequest;
use App\Models\TypeContract;
use Illuminate\Http\Request;

class TypeContractController extends Controller
{
    //list paginated risk types
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $TypeContract = TypeContract::select(
            'type_contracts.*',
        )->where('type_contracts.name', 'like', '%'.$request["search"].'%')
            ->orderBy('type_contracts.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $TypeContract
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_contracts = TypeContract::all();
        return response()->json([
            'res' => true,
            'data' => $type_contracts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTypeContracRequest $request)
    {
        $type_contract = TypeContract::create($request->all());
        if (!empty($type_contract)) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $type_contract,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar el tipo de contrato',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeContract  $typeContract
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $type_contract = TypeContract::find($id);
        if (!empty($type_contract)) {
            return response()->json([
                'res' => true,
                'data' => $type_contract
            ]);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el tipo de contrato',
                'data' => null
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeContract  $typeContract
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTypeContracRequest $request, int $id)
    {
        $type_contract = TypeContract::find($id);
        if (!empty($type_contract)) {
            $type_contract->update($request->all());
            return response()->json([
                'res' => true,
                'message' => 'Actualización exitosa',
                'data' => $type_contract
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el tipo de contrato',
                'data' => null
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeContract  $typeContract
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $type_contract = TypeContract::find($id);
        if (!empty($type_contract)) {
            $type_contract->delete();
            return response()->json([
                'res' => true,
                'message' => 'Eliminación exitosa',
                'data' => $type_contract
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el tipo de contrato',
                'data' => null
            ], 404);
        }
    }
}

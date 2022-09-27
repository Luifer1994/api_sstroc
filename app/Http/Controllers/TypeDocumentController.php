<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTypeContracRequest;
use App\Models\TypeDocument;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{

    //list paginated risk types
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $TypeDocument = TypeDocument::select(
            'type_documents.*',
        )->where('type_documents.name', 'like', '%'.$request["search"].'%')
            ->orderBy('type_documents.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $TypeDocument
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_documents = TypeDocument::all();
        return response()->json([
            'res'=>true,
            'data'=>$type_documents
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
        $type_document = TypeDocument::create($request->all());
        if (!empty($type_document)) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $type_document,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar el tipo de documento',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $type_document = TypeDocument::find($id);
        if (!empty($type_document)) {
            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $type_document,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el tipo de documento',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTypeContracRequest $request, int $id)
    {
        $type_document = TypeDocument::find($id);
        if (!empty($type_document)) {
            $type_document->update($request->all());
            return response()->json([
                'res' => true,
                'message' => 'Actualización exitosa',
                'data' => $type_document,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el tipo de documento',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $type_document = TypeDocument::find($id);
        if (!empty($type_document)) {
            $type_document->delete();
            return response()->json([
                'res' => true,
                'message' => 'Eliminación exitosa',
                'data' => $type_document,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro el tipo de documento',
                'data' => null,
            ], 404);
        }
    }
}

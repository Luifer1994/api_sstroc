<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $documents = Document::select('id', 'title', 'description', 'url','extension', 'created_at')
            //->with('user:id,name')
            ->orderBy('id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $documents
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDocumentRequest $request)
    {
        $request["user_id"] = Auth::user()->id;
        $document = Document::create($request->all());
        if ($document) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $document,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar docuemnto',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::find($id);
        if ($document) {
            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $document
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al buscar documento',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentRequest $request, $id)
    {
        $document = Document::find($id);
        if ($document) {
            $document->update($request->all());
            return response()->json([
                'res' => true,
                'message' => 'Registro actualizado',
                'data' => $document,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'El registro no existe',
                'data' => null,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}

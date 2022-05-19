<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTracingRequest;
use App\Models\ImageTracing;
use App\Models\Tracing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TracingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTracingRequest $request)
    {

        $new_tracing = new Tracing();
        $new_tracing->finding_id        = $request->finding_id;
        $new_tracing->description       = $request->description;
        $new_tracing->long_description  = $request->long_description ?? null;
        $new_tracing->user_id           = Auth::user()->id;

        if ($new_tracing->save()) {

            $files = $request->file('images');

            foreach ($files as $file) {
                $path = $file->store('tracings', ['disk' => 'my_files']);
                $save = new ImageTracing();
                $save->tracing_id   = $new_tracing->id;
                $save->url          = $path;

                if (!$save->save()) {
                    return response()->json([
                        'res'       => false,
                        'message'   => 'Error al crear seguimiento'
                    ], 400);
                }
            }
            return response()->json([
                'res'       => true,
                'message'   => 'Registro exitoso',
                'data'      => $new_tracing
            ], 200);
        } else {
            return response()->json([
                'res'       => false,
                'message'   => 'Error al crear hallazgo'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function show(Tracing $tracing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tracing $tracing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tracing $tracing)
    {
        //
    }
}

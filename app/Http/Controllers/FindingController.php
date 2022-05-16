<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFinding;
use App\Models\Finding;
use App\Models\ImageFinding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FindingController extends Controller
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
    public function store(StoreFinding $request)
    {
        $new_finding = new Finding();
        $new_finding->area_id           = $request->area_id;
        $new_finding->description       = $request->description;
        $new_finding->long_description  = $request->long_description ?? null;
        $new_finding->user_id           = Auth::user()->id;
        $new_finding->status            = 1;

        if ($new_finding->save()) {

            $files = $request->file('images');

            foreach ($files as $file) {
                $path = $file->store('public/images');
                //$name = $file->getClientOriginalName();
                $save = new ImageFinding();
                $save->finding_id   = $new_finding->id;
                $save->user_id      = $new_finding->user_id;
                $save->url          = $path;

                if (!$save->save()) {
                    return response()->json([
                        'res' => false,
                        'message' => 'Error al crear hallazgo'
                    ], 400);
                }
            }
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso'
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al crear hallazgo'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finding  $finding
     * @return \Illuminate\Http\Response
     */
    public function show(Finding $finding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finding  $finding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finding $finding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finding  $finding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finding $finding)
    {
        //
    }
}

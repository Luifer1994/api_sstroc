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
    public function index(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;

        $findings = Finding::select('*')
            ->with('user.employee', 'area', 'image_findings')
            ->withCount('tracings')
            ->orderBy('findings.id', 'DESC')
            ->paginate($limit);


        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $findings
        ], 200);
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

            foreach ($request->images as $file) {
                $save = new ImageFinding();
                $save->finding_id   = $new_finding->id;
                $save->user_id      = $new_finding->user_id;
                $save->url          = $file["url"];

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
    public function show($id)
    {
        $finding = Finding::with('area', 'user.employee', 'image_findings', 'tracings.image_tracings','tracings.user.employee')->find($id);

        if ($finding) {
            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $finding
            ], 200);
        }

        return response()->json([
            'res' => false,
            'message' => 'El hallazgo no existe'
        ], 400);
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

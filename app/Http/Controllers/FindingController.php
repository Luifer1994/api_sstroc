<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFinding;
use App\Models\Finding;
use App\Models\ImageFinding;
use App\Repositories\Finding\FindingRepositorie;
use App\Repositories\ImageFinding\ImageFindingRepositorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FindingController extends Controller
{

    private $findingRepositorie;
    private $imageFindingRepositorie;

    public function __construct(FindingRepositorie $findingRepositorie, ImageFindingRepositorie $imageFindingRepositorie)
    {
        $this->findingRepositorie = $findingRepositorie;
        $this->imageFindingRepositorie = $imageFindingRepositorie;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $limit = $request["limit"] ?? $limit = 10;

            $findings = $this->findingRepositorie->all($limit);

            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $findings
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['res' => false, 'message' => $th->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinding $request)
    {
        try {

            $request["user_id"] = Auth::user()->id;
            $request["status"]  = 1;
            $new_finding        = new Finding($request->all());

            DB::beginTransaction();
            $new_finding = $this->findingRepositorie->save($new_finding);

            if ($new_finding) {

                foreach ($request->images as $file) {

                    $new_image                = new ImageFinding();
                    $new_image->finding_id    = $new_finding->id;
                    $new_image->user_id       = $new_finding->user_id;
                    $new_image->url           =  $file["url"];

                    $new_image =   $this->imageFindingRepositorie->save($new_image);

                    if (!$new_image) {
                        DB::rollBack();
                        return response()->json([
                            'res' => false,
                            'message' => 'Error al crear hallazgo'
                        ], 400);
                    }
                }

                DB::commit();
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
        } catch (\Throwable $th) {
            return response()->json(['res' => false, 'message' => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finding  $finding
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $finding = $this->findingRepositorie->show($id);

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
        } catch (\Throwable $th) {
            return response()->json(['res' => false, 'message' => $th->getMessage()], 400);
        }
    }

    public function closed(int  $id)
    {
        try {
            $finding = $this->findingRepositorie->show($id);

            if ($finding) {
                $finding["status"] = 0;

                $finding =  $this->findingRepositorie->save($finding);
                return response()->json([
                    'res' => true,
                    'message' => 'Hallazgo cerrado con éxito',
                    'data' => $finding
                ], 200);
            }
            return response()->json([
                'res' => false,
                'message' => 'El hallazgo no existe'
            ], 400);
        } catch (\Throwable $th) {
            return response()->json(['res' => false, 'message' => $th->getMessage()], 400);
        }
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

    public function closedVsOPen()
    {
        $data = Finding::selectRaw('count(IF(status = 1,1,null)) as total_open')
        ->selectRaw('count(IF(status = 0,1,null)) as total_closed')
        ->first();
        return response()->json([
            'res'=>true,
            'data'=>$data
        ]);
    }
}

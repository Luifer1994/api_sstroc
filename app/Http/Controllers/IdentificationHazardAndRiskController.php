<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\IdentificationHazardAndRisk;
use App\Models\Risk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdentificationHazardAndRiskController extends Controller
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
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if (Risk::count() > count($request->responses)) {
                return response()->json([
                    'res' => false,
                    'message' => 'Faltan datos.'
                ], 400);
            } else {

                $employee = Employee::find($request->employee_id);
                $employee->register_identification_risk = Carbon::now();
                $employee->update();

                foreach ($request->responses as  $value) {
                    $value["employee_id"] = $request->employee_id;

                    $newIdenticationRisk = IdentificationHazardAndRisk::create($value);

                    if (!$newIdenticationRisk) {
                        DB::rollBack();
                        return response()->json([
                            'res' => false,
                            'message' => 'Error al guarar registro.'
                        ], 400);
                    }
                }
                DB::commit();
                return response()->json([
                    'res' => true,
                    'message' => 'Registro exitoso.'
                ], 200);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'res' => false,
                'message' => 'Error al guarar registro.'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentificationHazardAndRisk  $identificationHazardAndRisk
     * @return \Illuminate\Http\Response
     */
    public function show(IdentificationHazardAndRisk $identificationHazardAndRisk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IdentificationHazardAndRisk  $identificationHazardAndRisk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdentificationHazardAndRisk $identificationHazardAndRisk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationHazardAndRisk  $identificationHazardAndRisk
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationHazardAndRisk $identificationHazardAndRisk)
    {
        //
    }

    public function topRisk()
    {
        $data = Risk::select('id', 'name', 'risks_type_id')
            ->with('risk_type:id,name')
            ->withCount('identification_hazard_and_risks')
            ->whereHas('identification_hazard_and_risks', function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->subMonths(6), Carbon::now()])
                    ->where('response', true);
            })
            ->orderBy('identification_hazard_and_risks_count','DESC')
            ->limit(10)
            ->get();
        return response()->json([
            'res'=>true,
            'data'=>$data
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\RiskType;
use Illuminate\Http\Request;

class RiskTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riskTypes = RiskType::with('risks')->get();

        return response()->json(['res' => true, 'data' => $riskTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiskType  $riskType
     * @return \Illuminate\Http\Response
     */
    public function show(RiskType $riskType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiskType  $riskType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiskType $riskType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiskType  $riskType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiskType $riskType)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PensionFund;
use Illuminate\Http\Request;

class PensionFundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pension_funds = PensionFund::all();
        return response()->json([
            'res'=>true,
            'data'=>$pension_funds
        ]);
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
     * @param  \App\Models\PensionFund  $pensionFund
     * @return \Illuminate\Http\Response
     */
    public function show(PensionFund $pensionFund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PensionFund  $pensionFund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PensionFund $pensionFund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PensionFund  $pensionFund
     * @return \Illuminate\Http\Response
     */
    public function destroy(PensionFund $pensionFund)
    {
        //
    }
}

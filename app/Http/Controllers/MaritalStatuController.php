<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use Illuminate\Http\Request;

class MaritalStatuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marital_status = MaritalStatus::all();
        return response()->json([
            'res'=>true,
            'data'=>$marital_status
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
     * @param  \App\Models\MaritalStatu  $maritalStatu
     * @return \Illuminate\Http\Response
     */
    public function show(MaritalStatu $maritalStatu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaritalStatu  $maritalStatu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaritalStatu $maritalStatu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaritalStatu  $maritalStatu
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaritalStatu $maritalStatu)
    {
        //
    }
}

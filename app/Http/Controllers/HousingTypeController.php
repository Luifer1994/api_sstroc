<?php

namespace App\Http\Controllers;

use App\Models\HousingType;
use Illuminate\Http\Request;

class HousingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $housing_types = HousingType::all();
        return response()->json([
            'res'=>true,
            'data'=>$housing_types
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
     * @param  \App\Models\HousingType  $housingType
     * @return \Illuminate\Http\Response
     */
    public function show(HousingType $housingType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HousingType  $housingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HousingType $housingType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HousingType  $housingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(HousingType $housingType)
    {
        //
    }
}

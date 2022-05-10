<?php

namespace App\Http\Controllers;

use App\Models\Arl;
use Illuminate\Http\Request;

class ArlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arls = Arl::all();
        return response()->json([
            'res'=>true,
            'data'=>$arls
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
     * @param  \App\Models\Arl  $arl
     * @return \Illuminate\Http\Response
     */
    public function show(Arl $arl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Arl  $arl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arl $arl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arl  $arl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arl $arl)
    {
        //
    }
}

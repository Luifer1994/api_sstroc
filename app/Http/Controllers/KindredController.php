<?php

namespace App\Http\Controllers;

use App\Models\Kindred;
use Illuminate\Http\Request;

class KindredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kindreds = Kindred::all();
        return response()->json([
            'res'=>true,
            'data'=>$kindreds
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
     * @param  \App\Models\Kindred  $kindred
     * @return \Illuminate\Http\Response
     */
    public function show(Kindred $kindred)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kindred  $kindred
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kindred $kindred)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kindred  $kindred
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kindred $kindred)
    {
        //
    }
}

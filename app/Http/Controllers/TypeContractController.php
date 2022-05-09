<?php

namespace App\Http\Controllers;

use App\Models\TypeContract;
use Illuminate\Http\Request;

class TypeContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_contracts = TypeContract::all();
        return response()->json([
            'res'=>true,
            'data'=>$type_contracts
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
     * @param  \App\Models\TypeContract  $typeContract
     * @return \Illuminate\Http\Response
     */
    public function show(TypeContract $typeContract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeContract  $typeContract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeContract $typeContract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeContract  $typeContract
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeContract $typeContract)
    {
        //
    }
}

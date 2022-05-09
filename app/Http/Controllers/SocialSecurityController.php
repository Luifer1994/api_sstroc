<?php

namespace App\Http\Controllers;

use App\Models\SocialSecurity;
use Illuminate\Http\Request;

class SocialSecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $securities = SocialSecurity::all();
        return response()->json([
            'res'=>true,
            'data'=>$securities
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
     * @param  \App\Models\SocialSecurity  $socialSecurity
     * @return \Illuminate\Http\Response
     */
    public function show(SocialSecurity $socialSecurity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialSecurity  $socialSecurity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialSecurity $socialSecurity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialSecurity  $socialSecurity
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialSecurity $socialSecurity)
    {
        //
    }
}

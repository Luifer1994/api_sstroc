<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCountryRequest;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country = Country::all();
        return response()->json([
            'res'=>true,
            'data'=>$country
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        $country = Country::create($request->all());
        if(!empty($country)){
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $country,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar el pais',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        if(!empty($country)){
            return response()->json([
                'res' => true,
                'data' => $country
            ]);
        }else{
            return response()->json([
                'res' => false,
                'message' => 'Not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCountryRequest $request, $id)
    {
        $country = Country::find($id);
        if($country){
            if($country->fill($request->all())->save()){
                return response()->json([
                    'res' => true,
                    'data' => $country
                ]);
            }else{
                return response()->json([
                    'res' => false,
                    'message' => 'Error al registrar el pais',
                    'data' => null,
                ], 400);
            }

        }else{
            return response()->json([
                'res' => false,
                'message' => 'Not found'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
}

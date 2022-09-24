<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCityRequest;

class CityController extends Controller
{
    //lits all cities paginated
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $cities = City::select(
            'cities.*',
        )
            ->orderBy('cities.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $cities
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return response()->json([
            'res'=>true,
            'data'=>$cities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        $city = City::create($request->all());
        if(!empty($city)){
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $city,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar la ciudad',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);
        if(!empty($city)){
            return response()->json([
                'res' => true,
                'data' => $city
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
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCityRequest $request, $id)
    {
        $city = City::find($id);
        if($city){
            if($city->fill($request->all())->save()){
                return response()->json([
                    'res' => true,
                    'data' => $city
                ]);
            }else{
                return response()->json([
                    'res' => false,
                    'message' => 'Error al registrar la Ciudad',
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
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $city = City::find($id);
        if (!$city) {
            return response()->json([
                'res' => false,
                'message' => 'Ciudad no encontrada'
            ], 404);
        }
        $city->delete();
        return response()->json([
            'res' => true,
            'message' => 'Ciudad eliminada correctamente'
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PensionFund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PensionFundController extends Controller
{
    //lits all pension funds paginated
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $pension_funds = PensionFund::select(
            'pension_funds.*',
        ) ->where('pension_funds.name', 'like', '%'.$request["search"].'%')
            ->orderBy('pension_funds.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $pension_funds
        ], 200);
    }
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
        //validate name using the validator class
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $pension_fund = PensionFund::create($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Pension Fund creada correctamente',
            'data' => $pension_fund
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PensionFund  $pensionFund
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $pension_fund = PensionFund::find($id);
        if (!$pension_fund) {
            return response()->json([
                'res' => false,
                'message' => 'Fondo de pensión no encontrada'
            ], 404);
        }
        return response()->json([
            'res' => true,
            'data' => $pension_fund
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PensionFund  $pensionFund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $pension_fund = PensionFund::find($id);
        if (!$pension_fund) {
            return response()->json([
                'res' => false,
                'message' => 'Fondo de pensión no encontrada'
            ], 404);
        }
        $pension_fund->update($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Fondo de pensión actualizada correctamente',
            'data' => $pension_fund
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PensionFund  $pensionFund
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $pension_fund = PensionFund::find($id);
        if (!$pension_fund) {
            return response()->json([
                'res' => false,
                'message' => 'Fondo de pensión no encontrada'
            ], 404);
        }
        $pension_fund->delete();
        return response()->json([
            'res' => true,
            'message' => 'Fondo de pensión eliminada correctamente'
        ]);
    }
}

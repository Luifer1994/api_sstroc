<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends Controller
{

    function toArrayFilter( $model, array $filterArray ){
        return array_intersect_key( $model->toArray(), array_flip( $filterArray ) );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey_data = []; 
        $survey = Survey::find($id);
        if($survey){
            $survey_data['id'] = $survey->id;
            $survey_data['title'] = $survey->title;
            $survey_data['description'] = $survey->description;
            foreach($survey->questions as $question){
                if($question->required){
                    $question_data = self::toArrayFilter($question, [
                        'id',
                        'title',
                        'description',
                        'order',
                        'required',
                        'category'
                    ]);
                    $question_data['multiple_responses'] = [];
                    foreach($question->responses as $response){
                        $response_data = self::toArrayFilter($response, [
                            'id',
                            "indicator",
                            "text",
                            "response_true"
                        ]);
                        $response_data['question_next'] = null;
                        $question_next = $response->question;
                        if($question_next){
                            $response_data['question_next'] = self::toArrayFilter($question_next, [
                                'id',
                                'title',
                                'description',
                                'order',
                                'required',
                                'category'
                            ]);
                        }
                        $question_data['multiple_responses'][] = $response_data;
                    }
                    $survey_data['questions'][] = $question_data;
                }
            }
        }
        if(!empty($survey_data)){
            return response()->json([
                'res' => true,
                'data' => $survey_data
            ]);
        }else{
            return response()->json([
                'res' => false,
                'message' => 'Not found'
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_questions_survey(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

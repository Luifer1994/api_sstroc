<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\EmployeesHasQuestion;
use Illuminate\Support\Facades\DB;

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
    public function save_questions_survey( Request  $request, $survey_id)
    {
        if(!empty($request->responses)){
            $request_data = $request->all();
            $employee_responses = $request_data['responses'];
            $survey = Survey::find($survey_id);
            if($survey){
                DB::beginTransaction();
                foreach($survey->questions as $question){
                    $key_response = array_search( $question->id, array_column($employee_responses, 'question_id'));
                    if($question->required && !is_numeric($key_response) ){ 
                        return response()->json([
                            'res' => false,
                            'message' => 'La pregunta :' . $question->title . ' es requerida',
                            'question_id' => $question->id
                        ]);
                    }
                    if(is_numeric($key_response)){
                        $employee_response = $employee_responses[$key_response];
                        $employee_response['employee_id'] = $request_data['employee_id'];
                        $question_responses = $question->responses->all();
                        if($question_responses){
                            if(!empty($employee_response['response_id'])){
                                $key_question_response = array_search($employee_response['response_id'], array_column($question_responses, 'id') );
                                if(is_numeric($key_question_response)){
                                    
                                    if($this->add_employee_question($employee_response)){
                                        continue;
                                    }else{
                                        print_r($employee_response);
                                    
                                        DB::rollBack();
                                        return response()->json([
                                            'res' => false,
                                            'message' => 'Error al registrar la respuesta a la pregunta: ' . $question->title,
                                            'question_id' => $question->id,
                                            'data' => null,
                                        ], 400);
                                    }
                                }

                            }else{
                                DB::rollBack();
                                return response()->json([
                                    'res' => false,
                                    'message' => 'La respuesta la pregunta: ' . $question->title . ' es requerida',
                                    'question_id' => $question->id
                                ]);
                            }
                        }
                        if(!empty($employee_response['response'])){
                            if($this->add_employee_question($employee_response)){
                                continue;
                            }else{
                                DB::rollBack();
                                return response()->json([
                                    'res' => false,
                                    'message' => 'Error al registrar la respuesta a la pregunta: ' . $question->title,
                                    'question_id' => $question->id,
                                    'data' => null,
                                ], 400);
                            }
                        }else{
                            DB::rollBack();
                            return response()->json([
                                'res' => false,
                                'message' => 'La respuesta la pregunta: ' . $question->title . ' es requerida',
                                'question_id' => $question->id
                            ]);
                        }
                        
                    }
                }
                DB::commit();
                return response()->json([
                    'res' => true,
                    'message' => 'Registro exitoso',
                    'data' => null,
                ], 200);
            }
        }
        DB::rollBack();
        return response()->json([
            'res' => false,
            'message' => 'No se enviaron respuestas'
        ]);
    }

    public function add_employee_question( array $data):bool{
        $question  = new EmployeesHasQuestion();
        $question->employee_id = $data['employee_id'];
        $question->question_id = $data['question_id'];
        $question->response = $data['response']??null;
        $question->response_id = $data['response_id']??null;
        return  $question->save();
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

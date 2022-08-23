<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    protected $Question;
    public function  __construct(Question $Question)
    {
        $this->Question=$Question;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( $this->Question::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $validator = Validator::make($request->all(), [
            'question'=>'required|string',
            'answer'=>'required|string',
            'question_ar'=>'required|string',
            'answer_ar'=>'required|string',
        ]);
        if($validator->fails()){
            return  response()->json($validator->errors());

        }
        $create_question= $this->Question;


        $create_question::create([
            'question'=>$request->question,
            'answer'=>$request->answer,
            'question_ar'=>$request->question_ar,
            'answer_ar'=>$request->answer_ar,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json($this->Question::findOrFail($id));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id){


         $validator = Validator::make($request->all(), [
             'question'=>'required|string',
             'answer'=>'required|string',
             'question_ar'=>'required|string',
             'answer_ar'=>'required|string',
        ]);
        if($validator->fails()){
            return  response()->json($validator->errors());

        }
        $create_question= $this->Question::findOrFail($id);

        $create_question->update([
            'question'=>$request->question,
            'answer'=>$request->answer,
            'question_ar'=>$request->question_ar,
            'answer_ar'=>$request->answer_ar,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Question::findOrFail($id)->delete();
        return 'deleted';
    }
}

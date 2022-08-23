<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Validator;

use App\Models\Goal;
use Illuminate\Http\Request;
use App\Http\Requests\GoalValidator;
class GoalController extends Controller
{

    use FileUploadTrait;

    protected $Goal;
    public function  __construct(Goal $Goal)
    {
        $this->Goal=$Goal;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  response()->json($this->Goal::all());
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
            'title'=>'required|string',
            'description'=>'required|string',
            'header'=>'required|string',
            'header_ar'=>'required|string',
            'title_ar'=>'required|string',
            'description_ar'=>'required|string'
        ]);

        if($validator->fails()){
             return  response()->json($validator->errors());

        }

        $create_goal= $this->Goal;

        if ($request->hasFile('image')){
            $image_name= $this->uploadFile($request->image,'uploads/goals/');
        }

        //$image_name=$request->image->hashName();
        $create_goal::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'header'=>$request->header,
            'header_ar'=>$request->header_ar,
            'title_ar'=>$request->title_ar,
            'description_ar'=>$request->description_ar,
            'images'=>isset($image_name) ? 'uploads/goals/' . $image_name : null,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json($this->Goal::findOrFail($id));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title'=>'required|string',
            'description'=>'required|string',
            'header'=>'required|string',
            'header_ar'=>'required|string',
            'title_ar'=>'required|string',
            'description_ar'=>'required|string'
        ]);

        if($validator->fails()){
            return  response()->json($validator->errors());

        }

        $update_goal= $this->Goal::findOrFail($id);

        if ($request->hasFile('image')){
            $image_name= $this->uploadFile($request->image,'uploads/goals/');
        }

        //$image_name=$request->image->hashName();
        $update_goal->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'header'=>$request->header,
            'header_ar'=>$request->header_ar,
            'title_ar'=>$request->title_ar,
            'description_ar'=>$request->description_ar,
            'images'=>isset($image_name) ? 'uploads/goals/' . $image_name : $update_goal->images,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use App\Models\Feature;
use App\Models\Reviewn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewnController extends Controller
{

    use FileUploadTrait;
    protected $reviews;
    public function  __construct(Reviewn $reviews)
    {
        $this->reviews=$reviews;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( $this->reviews::all());

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
            'name'=>'required|string',
            'description'=>'required|string',
            'description_ar'=>'required|string',
        ]);
        if($validator->fails()){
            return  response()->json($validator->errors());

        }
        $create_reviews= $this->reviews;

        if ($request->hasFile('image')){
            $image_name= $this->uploadFile($request->image,'uploads/reviews/');
        }

        //$image_name=$request->image->hashName();
        $create_reviews::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'description_ar'=>$request->description_ar,
            'image'=>isset($image_name) ? 'uploads/reviews/' . $image_name : null,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reviewn  $reviewn
     * @return \Illuminate\Http\Response
     */
    public function show(Reviewn $reviewn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reviewn  $reviewn
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json($this->reviews::findOrFail($id));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reviewn  $reviewn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'description'=>'required|string',
            'description_ar'=>'required|string',
        ]);
        if($validator->fails()){
            return  response()->json($validator->errors());

        }

        $create_reviews= $this->reviews::findOrFail($id);

        if ($request->hasFile('image')){

            $image_name= $this->uploadFile($request->image,'uploads/reviews/');
        }

        $create_reviews->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'description_ar'=>$request->description_ar,
            'image'=>isset($image_name) ? 'uploads/reviews/' . $image_name : null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reviewn  $reviewn
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->reviews::findOrFail($id)->delete();
        return 'deleted';
    }
}

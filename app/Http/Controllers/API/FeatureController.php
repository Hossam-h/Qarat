<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{

    use FileUploadTrait;
    protected $Feature;
    public function  __construct(Feature $Feature)
    {
        $this->Feature=$Feature;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return response()->json( $this->Feature::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $create_feature= $this->Feature;

        if ($request->hasFile('image')){
            $image_name= $this->uploadFile($request->image,'uploads/feature/');
        }

        //$image_name=$request->image->hashName();
        $create_feature::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'title_ar'=>$request->title_ar,
            'description_ar'=>$request->description_ar,
            'image'=>isset($image_name) ? 'uploads/feature/' . $image_name : null,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json($this->Feature::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $update_feature= $this->Feature::findOrFail($id);
       //dd($update_feature);
        if ($request->hasFile('image')){
            $image_name= $this->uploadFile($request->image,'uploads/feature/');
        }

        //$image_name=$request->image->hashName();
        $update_feature->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'title_ar'=>$request->title_ar,
            'description_ar'=>$request->description_ar,
            'image'=>isset($image_name) ? 'uploads/feature/' . $image_name : $update_feature->image,
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $this->Feature::findOrFail($id)->delete();
                return 'deleted';
    }
}

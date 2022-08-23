<?php

namespace App\Http\Controllers\API;

use App\Models\Main;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    use FileUploadTrait;

   protected $maim;

    public function  __construct(Main $main)
    {
       $this->maim=$main;
    }

    public function  index(){
        return response()->json($this->maim::all());
    }

    public function  update($id,Request $request){

        $validator = Validator::make($request->all(), [
            'title'=>'required|string',
            'Content'=>'required|string',
            'trail'=>'required|string',
            'title_ar'=>'required|string',
            'Content_ar'=>'required|string',
            'trail_ar'=>'required|string',
        ]);
        if($validator->fails()){
            return  response()->json($validator->errors());

        }
       $main_update= $this->maim->findOrFail($id);

       if ($request->hasFile('image')){
           $image_name= $this->uploadFile($request->image,'uploads/main/');
       }

         //$image_name=$request->image->hashName();
        $main_update->update([
            'title'=>$request->title,
            'content'=>$request->Content,
            'trail'=>$request->trail,
            'title_ar'=>$request->title_ar,
            'content_ar'=>$request->Content_ar,
            'trail_ar'=>$request->trail_ar,
              'images'=>isset($image_name) ? 'uploads/main/' . $image_name : $main_update->images,
        ]);
    }

    public function  edit($id){
        return response()->json($this->maim::findOrFail($id));
    }
}

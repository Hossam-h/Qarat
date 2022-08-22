<?php

namespace App\Http\Controllers\API;

use App\Models\Main;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\FileUploadTrait;

class MainController extends Controller
{
    use FileUploadTrait;

   protected $maim;

    public function  __construct(Main $main)
    {
       $this->maim=$main;
    }

    public function  index(){
        return response(Main::all());
    }

    public function  update($id,Request $request){
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
}

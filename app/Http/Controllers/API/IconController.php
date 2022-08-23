<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IconController extends Controller
{

    protected $Icon;
    public function  __construct(Icon $Icon)
    {
        $this->Icon=$Icon;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->Icon::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $validator = Validator::make($request->all(), [
            'icons'=>'required|string',
            'links'=>'required|string',
        ]);
        if($validator->fails()){
            return  response()->json($validator->errors());

        }

        $create_icon= $this->Icon;
        $create_icon::create([
            'icons'=>$request->icons,
            'links'=>$request->links,

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function show(Icon $icon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json($this->Icon::findOrFail($id));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'icons'=>'required|string',
            'links'=>'required|string',
        ]);
        if($validator->fails()){
            return  response()->json($validator->errors());

        }
        $update_icons= $this->Icon::findOrFail($id);


        $update_icons->update([
            'icons'=>$request->icons,
            'links'=>$request->links,

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Icon::findOrFail($id)->delete();
        return 'deleted';
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Minicourse;

class MinicourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'minicourse_name' => 'required',
            'link_video' => 'required',
            'link_doc' => 'required',
            'link_other_resource' => 'required',
            'mc_thumbnail' => 'required',
            'subcourse_id' => 'required',
            'description' => 'required'
        ]);
        
        $minicourse = new Minicourse;

        $minicourse->minicourse_name = $request->minicourse_name;
        $minicourse->link_video = $request->link_video;
        $minicourse->link_doc = $request->link_doc;
        $minicourse->link_other_resource = $request->link_other_resource;
        $minicourse->mc_thumbnail = $request->mc_thumbnail;
        $minicourse->subcourse_id = $request->subcourse_id;
        $minicourse->description = $request->description;

        if($minicourse->save()){
            return response()->json(["message" => "tambah materi berhasil"],200);
        }
        return response()->json(["message" => "tambah materi gagal"],400);
       
    }

    public function showByCourse($courseid)
    {
        return Minicourse::where('subcourse_id',$courseid)->get();
    }
    public function showById($id)
    {
        return Minicourse::find($id);
    }
    
}

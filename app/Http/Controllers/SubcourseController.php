<?php

namespace App\Http\Controllers;

use App\CourseTitles;
use App\Course;
use App\Subcourse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class SubcourseController extends Controller
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

    //
   
    public function createSubcourse(Request $request)
    {
        $this->validate($request,[
            'subcourse_name' => 'required',
            'sc_thumbnail' => 'required',
            'course_id' => 'required'
        ]);
        $course = new Subcourse;

        $course->subcourse_name = $request->subcourse_name;
        $course->sc_thumbnail = $request->sc_thumbnail;
        $course->course_id = $request->course_id;

        if($course->save()){
            return response()->json(["message" => "Tambah subcourse Berhasil"],200);
        }
        return response()->json(["message" => "Tambah subcourse gagal"],400);
    }

    public function getSubcourseByCourse($course)
    {
        return Course::where('id',$course)->with(['subcourses','subcourses.minicourse'])->first();
    }
}


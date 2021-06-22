<?php

namespace App\Http\Controllers;

use App\CourseTitles;
use App\Course;
use App\Subcourse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class CourseController extends Controller
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
    public function createTitles(Request $request)
    {

        $this->validate($request,[
            'title' => 'required'
        ]);

        $titles = new CourseTitles;

        $titles->title = $request->title;
        if($titles->save()){
            return response()->json(["message" => "Tambah titles Berhasil"],200);
        }
        return response()->json(["message" => "Gagal tambah titles"],400);
        
    }

    public function createCourse(Request $request)
    {
        $this->validate($request,[
            'course_name' => 'required',
            'price' => 'required',
            'title_id' => 'required',
            'crs_thumbnail' => 'required'
        ]);
        $course = new Course;

        $course->course_name = $request->course_name;
        $course->price = $request->price;
        $course->title_id = $request->title_id;
        $course->crs_thumbnail = $request->crs_thumbnail;

        if($course->save()){
            return response()->json(["message" => "Tambah course Berhasil"],200);
        }
        return response()->json(["message" => "Tambah course gagal"],400);
    }

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

    public function getCourseByTitle($title)
    {
        return CourseTitles::where('title',$title)->with(['courses'])->get();
    }
}

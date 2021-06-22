<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Membership;
class MembershipController extends Controller
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

    public function index()
    {
        return Membership::all();
    }
    public function store(Request $request)
    {
        $membership = new Membership;

        $membership->course_id = $request->course_id;
        $membership->price = $request->price;
        $membership->feature = $request->feature;
        
        if($membership->save())
        {
            return response()->json(["message" => 'membership berhasil disimpan'],200);
        }
        return response()->json(["message" => 'membership gagal disimpan'],400);
    }
    
    public function getMembership($courseid)
    {
        return Membership::where('course_id',$courseid)->with('membership')->get();
    }
}

<?php

namespace App\Http\Controllers;
use App\UserMembership;
use Illuminate\Http\Request;
class UserMembershipController extends Controller
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
            'membership_id' => 'required',
            'user_id' => 'required',
            'course_id' => 'required'
        ]);

        $um = new UserMembership;
        $um->membership_id = $request->membership_id;
        $um->user_id = $request->user_id;
        $um->course_id = $request->course_id;
        
        if($um->save())
        {
            return response()->json(['message' => 'Berhasil disimpan'],200);
        }
        return response()->json(['message' => 'gagal disimpan'],400);
    }
}

<?php

namespace App\Http\Controllers;
use App\Webinar;
use App\WebinarParticipant;
use Illuminate\Http\Request;
use DB;
class WebinarController extends Controller
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

    public function getAll()
    {
        return Webinar::select('*')->orderBy('status','desc')->get();
    }

    public function getById($id)
    {
        return Webinar::where('id',$id)->firstOrFail();
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            "webinar_name" => 'required',
            "description" => 'required',
            'price' => 'required',
            'flyer' => 'required',
            'closed_at' => 'required',
        ]);

        if(Webinar::create($request->all())){
            return response()->json(['message' => 'webinar berhasil disimpan'],200);
        }
        return response()->json(['message' => 'webinar gagal disimpan'],00);
    }

    public function registerWebinar(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'webinar_id' => 'required'
        ]);

        $webinarparticipant = new WebinarParticipant;
        $webinarparticipant->user_id = $request->user_id;
        $webinarparticipant->webinar_id = $request->webinar_id;

        if($webinarparticipant->save()) 
        {
            return response()->json([
                "message" => "Pendaftaran webinar berhasil"
            ], 200);
        }

        return response()->json([
            "message" => "Pendaftaran webinar gagal"
        ], 400);
    }

    public function mywebinar($userid){
        $my = DB:: table('webinar_participants')
                ->select(DB::raw('count(*) as count,webinar_id'))
                ->where('user_id','=',$userid)
                ->where('approval_status','=','yes')
                ->groupBy('webinar_id');
        $webinars = DB::table('webinars')
                    ->joinSub($my, 'webinar_participants', function($join) {
                        $join->on('webinars.id','=','webinar_participants.webinar_id');
                    })->get();
        return $webinars;
    }
}

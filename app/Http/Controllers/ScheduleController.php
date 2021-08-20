<?php

namespace App\Http\Controllers;
use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function getBySubcourseId($id)
    {
        $schedules = Schedule::where('subcourse_id', $id)->get();

        return response()->json([
            'schedules' => $schedules
        ]);
    }
}

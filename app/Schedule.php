<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'subcourse_schedules';
    public function subcourse()
    {
        return $this->belongsTo('App\Subcourse');
    }
}

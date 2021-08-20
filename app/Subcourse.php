<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Subcourse extends Model{
    use SoftDeletes;
    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function minicourse()
    {
        return $this->hasMany('App\Minicourse');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }
}
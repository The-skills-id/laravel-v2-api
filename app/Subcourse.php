<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Subcourse extends Model{
    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function minicourse()
    {
        return $this->hasMany('App\Minicourse');
    }
}
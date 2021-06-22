<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model{
    protected $table = 'membership';

    public function course()
    {
        return $this->belongsTo('App\Course','course_id');
    }
}
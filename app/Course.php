<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Course extends Model{
    public function hasTitle()
    {
        return $this->belongsTo('App\CourseTitles','title_id');
    }

    public function membership()
    {
        return $this->hasMany('App\Membership','id');
    }
    public function subcourses()
    {
        return $this->hasMany('App\Subcourse');
    }
}
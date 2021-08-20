<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Course extends Model{
    use SoftDeletes;
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

    public function users()
    {
        return $this->belongsToMany('App\User', 'courses_taken');
    }
}
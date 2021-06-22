<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class CourseTitles extends Model{

    protected $table = 'course_titles';

    public function courses()
    {
        return $this->hasMany('App\Course','title_id');
    }
}
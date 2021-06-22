<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Webinar extends Model{
    protected $fillable = ["webinar_name" ,"description" ,'price' ,'flyer' ,'closed_at' ];
}
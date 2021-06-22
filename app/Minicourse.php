<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Minicourse extends Model{
    public function subcourse()
    {
        return $this->belongsTo('App\Subcourse');
    }
}
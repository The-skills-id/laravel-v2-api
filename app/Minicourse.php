<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Minicourse extends Model{
    use SoftDeletes;
    public function subcourse()
    {
        return $this->belongsTo('App\Subcourse');
    }
}
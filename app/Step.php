<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public function arta()
    {
        return $this->belongsTo('App\Arta');
    }

    public function stepmedias()
    {
        return $this->hasMany('App\Stepmedia');
    }
}

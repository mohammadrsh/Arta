<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function artas()
    {
        return $this->belongsToMany('App\Arta');
    }
}

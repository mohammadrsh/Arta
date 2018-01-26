<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    public function Arta()
    {
        return $this->belongsTo('App\Arta');
    }
}

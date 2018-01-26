<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    public function arta()
    {
        return $this->belongsTo('App\Arta');
    }
}

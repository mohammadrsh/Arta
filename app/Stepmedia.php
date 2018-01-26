<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stepmedia extends Model
{
    public function step()
    {
        return $this->belongsTo('App\Step');
    }

    public function arta()
    {
        return $this->belongsTo('App\Arta');
    }
}

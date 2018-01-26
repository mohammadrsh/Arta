<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function arta()
    {
        return $this->belongsTo('App\Arta');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

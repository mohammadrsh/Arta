<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    public function artas()
    {
        return $this->hasMany('App\Arta', 'cat_id');
    }
}

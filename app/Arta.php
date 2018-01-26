<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arta extends Model
{
    public function pics()
    {
        return $this->hasMany('App\Pic');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function tools()
    {
        return $this->hasMany('App\Tool');
    }

    public function steps()
    {
        return $this->hasMany('App\Step');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function cat()
    {
        return $this->belongsTo('App\Catagory');
    }
}

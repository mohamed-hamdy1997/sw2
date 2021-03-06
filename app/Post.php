<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function likes(){
        return $this->hasMany('App\Like');
//        return $this->hasMany('App\Comment');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
//        return $this->hasMany('App\Comment');
    }

}

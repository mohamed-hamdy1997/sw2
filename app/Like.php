<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    public $table = 'likes';
    public $timestamps =false;

    public function post(){
//        return $this->belongsTo('App\Post');
        return $this->belongsTo(Post::class);
    }
    public function user(){
//        return $this->belongsTo('App\User');
        return $this->belongsTo(User::class);
    }
}

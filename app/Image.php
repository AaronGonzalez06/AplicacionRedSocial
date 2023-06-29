<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    
    //relacion one to many de uno a muchos
    
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id','desc');
    }
    
    public function likes(){
        return $this->hasMany('App\Like');
    }
    //de muchos a uno
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }    
}

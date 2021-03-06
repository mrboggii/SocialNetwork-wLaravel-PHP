<?php

namespace App;

//use App\User;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $guarded=[];
    public function user(){
        return $this->belongsTo('App\User','id_user');
    }
    public function likes(){
        return $this->belongsToMany('App\User', 'likes', 'id_publication', 'id_user');
    }
    public function comments(){
        return $this->hasMany('App\Comment','id_publication');
    }
}

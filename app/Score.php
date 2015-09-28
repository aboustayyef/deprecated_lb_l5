<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['facebook', 'twitter', 'total', 'virality'];

    public function post(){
    	return $this->belongsTo('App\Post');
    }

}

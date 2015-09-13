<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

	protected $fillable = array('url', 'height', 'width');

    public function post(){
    	return $this->belongsTo('App\Post');
    }
    public function source(){
    	return $this->post()->source;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

	protected $fillable = array('title', 'url', 'excerpt', 'content', 'publishing_date');

	public function source(){
		return $this->belongsTo('App\Source');
	}

	public function channels()
	{
		return $this->belongsToMany('App\Channel');
	}

	public function image()
	{
		return $this->hasOne('App\Image');
	}

}

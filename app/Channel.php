<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model {

	protected $table = 'channels';
	public $timestamps = true;
	protected $fillable = array('shorthand', 'description');
	protected $visible = array('shorthand', 'description');

	public function blogs()
	{
		return $this->belongsToMany('App\Blog');
	}

	public function posts()
	{
		return $this->belongsToMany('App\Post');
	}


	public function parent()
	{
		return $this->belongsTo('App\Channel');
	}

	public function children(){
		return $this->hasMany('App\Channel', 'parent_id');
	}


	public function topLevel(){
		return $this->where('parent_id', 0);
	}


}
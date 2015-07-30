<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model {

	protected $table = 'sources';
	public $timestamps = true;
	protected $fillable = array('shorthand', 'name', 'description', 'url', 'author', 'author_twitter', 'author_email', 'rss_feed', 'active');
	protected $visible = array('shorthand', 'name', 'description', 'url', 'author', 'author_twitter', 'author_email', 'rss_feed', 'active');

	public function posts()
	{
		return $this->hasMany('App\Post');
	}

	public function channels()
	{
		return $this->hasMany('App\Channel');
	}

}
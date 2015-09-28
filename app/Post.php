<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ScoresGetter;
use \Cache;
use App\Channel;

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

	public function scores()
	{
		return $this->hasMany('App\Score');
	}

	/*
	 * Get Scores from Social media
	 */
	public function getScores(){
		(new ScoresGetter($this))->get();
	}

	/*
	 * Gets a Cache of the last 200 items
	 */
	
	public static function getCache($channel = null){

		$cacheKey = 'last200'.$channel.'posts';
	    
	    if (! Cache::has($cacheKey)) { // if no cache exists
	    	if (is_null($channel)) { // if all posts (no channel)
	    		$tempPosts = Post::with('source')->with('scores')->orderBy('publishing_date','desc')->take(200)->get()->chunk(20);
	    	} else { // channel
	    		$tempPosts = Channel::where('shorthand',$channel)->first()->posts()->with('source')->with('scores')->orderBy('publishing_date','desc')->take(200)->get()->chunk(20);
	    	}
	    	// if no results, return false
	    	if ($tempPosts->count() == 0) {
	    		return false;
	    	}
	    	
	    	// If all ok, cache results for 10 minutes       
            Cache::put($cacheKey, $tempPosts , 10);
        }

        return Cache::get($cacheKey);
	}

}

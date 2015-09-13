<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostCrawlers\PostLists\RssListGetter;
use App\PostCrawlers\PostLists\ListChooser;
use App\PostCrawlers\PostDetails\DetailsChooser;

class Source extends Model {

	protected $table = 'sources';
	public $timestamps = true;
	protected $fillable = array('shorthand', 'name', 'description', 'url', 'author', 'author_twitter', 'author_email', 'rss_feed', 'media_parent', 'active');
	protected $visible = array('shorthand', 'name', 'description', 'url', 'author', 'author_twitter', 'author_email', 'rss_feed', 'media_parent', 'active');

	public function posts()
	{
		return $this->hasMany('App\Post');
	}

	public function channels()
	{
		return $this->belongsToMany('App\Channel');
	}


	// Convenience Functions
	
	static function has($shorthand){
		return Source::where('shorthand', $shorthand )->count() > 0;
	}

	/*
	Looks if this url was published before
	 */
	public function hasPublished($url){
		return $this->posts()->where('url',$url)->get()->count() > 0;
	}

	// Crawling Functions

	public function crawlLatestPosts(){
		
		$posts = new ListChooser($this->url, $this->rss_feed, $this->media_parent);
		return $posts->getList();
	}

	public function crawlPostDetails($link, $verbose = true){
		$details = new DetailsChooser($link, $this->rss_feed, $this->media_parent, $verbose);
		return $details->getDetails();
	}



	// not tested yet;
	public function channelsList()
	{
		$channelsList = [];
		$channels = $this->channels;
		foreach ($channels as $channel) {
			$channelList[$channel->id] = $channel->shorthand;
		}
		return $channelsList;
	}

}
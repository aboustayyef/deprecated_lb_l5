<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostGetters\PostLists\RssListGetter;
use App\PostGetters\PostLists\ListChooser;
use App\PostGetters\PostDetails\DetailsChooser;

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
		return $this->belongsToMany('App\Channel');
	}

	public function crawlLatestPosts(){
		
		$posts = new ListChooser($this->url, $this->rss_feed);
		return $posts->getList();
	}

	public function crawlPostDetails($link){
		$details = new DetailsChooser($link, $this->rss_feed, $verbose = true);
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
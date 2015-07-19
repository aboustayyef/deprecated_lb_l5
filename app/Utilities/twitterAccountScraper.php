<?php 

namespace App\Utilities;

/**
* Gets Twitter Info from a twitter username 
* does NOT use the Scraper class as parent.
*/

class TwitterAccountScraper
{
	
	public $info;

	function __construct($username = 'beirutspring')
	{
		// prepare the client;
		$twitterClient = new \Twitter(getenv('TWITTER_CONSUMER_KEY'), getenv('TWITTER_CONSUMER_SECRET'), getenv('TWITTER_ACCESS_TOKEN'),getenv('TWITTER_ACCESS_TOKEN_SECRET'));
	
		// populate info
		try {
			$this->info = $twitterClient->request('users/show','GET',['screen_name'=>$username]);
		} catch (Exception $e) {
			return "Exception: $e";
		}
	}

	// convenience functions
	
	public function name(){
		return $this->info->name;
	}

	public function description(){
		return $this->info->description;
	}

	public function profilePic(){
		return $this->info->profile_image_url;
	}

}



?>
<?php 

Namespace App\PostCrawlers\PostDetails;

use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
use Aboustayyef\ImageExtractor;

class RssDetailsGetter 
{
	protected $url, $feed;
	public function __construct($url, $feed){
		$this->url = arabicUrlencode($url);
		$this->feed = $feed;
	}

	function getDetails(){

		$collection = $this->feed->get_items(0,10);
		foreach ($collection as $key => $link) {

			$finalUrl = finalUrl($link->get_permalink());

			if (starts_with($finalUrl, $this->url)) {

				return [
					'url'				=> $this->url,
					'title'				=> $this->getTitle($link),
					'publishing_date'	=> $this->getDate($link),
					'content'			=> $this->getContent($link),
				];

				// Todo: Get Details
			};
		}
	}

	function getTitle($link){
		return $link->get_title();
	}


	function getDate($link){
		return new Carbon($link->get_date());
	}


	function getContent($link){
		return $link->get_content();
	}

}


?>


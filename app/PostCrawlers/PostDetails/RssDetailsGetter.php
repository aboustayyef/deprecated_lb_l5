<?php 

Namespace App\PostCrawlers\PostDetails;

use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
use Aboustayyef\ImageExtractor;

class RssDetailsGetter 
{
	protected $url, $feed, $verbose;
	public function __construct($url, $feed, $verbose=false){
		$this->url = arabicUrlencode($url);
		$this->feed = $feed;
		$this->verbose = $verbose;
	}

	function getDetails(){

		if ($this->verbose) {
			echo "*** Getting collection of Posts from feed" . PHP_EOL;
		}

		$collection = $this->feed->get_items(0,10);

		if ($this->verbose) {
			echo "*** Iterating through list to find Item object matching given url" . PHP_EOL;
		}

		foreach ($collection as $key => $link) {

			$finalUrl = finalUrl($link->get_permalink());

			if ($this->verbose) {
				echo "*** Comparing $finalUrl to $this->url" . PHP_EOL;
			}

			if (starts_with($finalUrl, $this->url)) {

				if ($this->verbose) {
					echo "*** Item found (number $key)" . PHP_EOL;
				}

				return [
					'url'		=> $this->url,
					'title'		=> $this->getTitle($link),
					'date'		=> $this->getDate($link),
					'content'	=> $this->getContent($link),
					'image'		=> $this->getImage($link)
				];

				// Todo: Get Details
			};
		}
		if ($this->verbose) {
			echo "/!\\ Warning! No Item was found" . PHP_EOL;
		}
	}

	function getTitle($link){
		if ($this->verbose) {
			echo "*** getting Title ". PHP_EOL;
		}
		return $link->get_title();
	}


	function getDate($link){
		if ($this->verbose) {
			echo "*** getting Date". PHP_EOL;
		}
		return new Carbon($link->get_date());
	}


	function getContent($link){
		if ($this->verbose) {
			echo "*** getting Content". PHP_EOL;
		}
		return $link->get_content();
	}


	function getImage(){
		if ($this->verbose) {
			echo "*** getting Image". PHP_EOL;
		}
		$imageExtractor = new ImageExtractor($this->url);
		return $imageExtractor->get(400);
	}


}


?>


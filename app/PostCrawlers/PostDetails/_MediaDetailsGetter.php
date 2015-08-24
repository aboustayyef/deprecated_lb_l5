<?php 

Namespace App\PostCrawlers\PostDetails;

use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
use Aboustayyef\ImageExtractor;


abstract class _MediaDetailsGetter
{

	// common initialization logic
	protected $url, $crawler, $verbose;
	
	public function __construct($url, $crawler, $verbose=false){
		$this->url = $url;
		$this->crawler = $crawler;
		$this->verbose = $verbose;
	}

	// common functions

	public function getDetails(){
		return [
					'url'		=> $this->url,
					'title'		=> $this->getTitle(),
					'date'		=> $this->getDate(),
					'content'	=> $this->getContent(),
					'image'		=> $this->getImage()
				];
	}

	function getImage(){
		$imageExtractor = new ImageExtractor($this->url);
		return $imageExtractor->get(400);
	}

	// functions that differ between media sources
	
	abstract function getTitle();
	abstract function getDate();
	abstract function getContent();

}


?>
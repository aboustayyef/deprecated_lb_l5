<?php 

Namespace App\PostCrawlers\PostDetails;

use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
use Aboustayyef\ImageExtractor;


abstract class _MediaDetailsGetter
{

	// common initialization logic
	protected $url, $crawler, $verbose;
	
	public function __construct($url, $crawler){
		$this->url = $url;
		$this->crawler = $crawler;
	}

	// common functions

	public function getDetails(){
		return [
					'url'				=> $this->url,
					'title'				=> $this->getTitle(),
					'publishing_date'	=> $this->getDate(),
					'content'			=> $this->getContent(),
				];
	}

	// functions that differ between media sources
	
	abstract function getTitle();
	abstract function getDate();
	abstract function getContent();

}


?>
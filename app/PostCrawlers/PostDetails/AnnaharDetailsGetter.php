<?php 

Namespace App\PostCrawlers\PostDetails;

use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
use Aboustayyef\ImageExtractor;


class AnnaharDetailsGetter extends _MediaDetailsGetter
{
	
	function getTitle(){
		$title = $this->crawler
					  ->filter('.title h1')
					  ->first()->text();
		return $title;
	}


	function getDate(){
		$date = $this->crawler
					 ->filter('[itemprop="datePublished"]')
					 ->first()->attr('content');
		$date = str_replace(" ", "", $date);
		$date = new Carbon($date);
		return $date;
	}


	function getContent(){
		$content = '';
		$paragraphs = $this->crawler->filter('[itemprop="articleBody"] p');
		foreach ($paragraphs as $key => $paragraph) {
			$content .= '<p>' . $paragraph->nodeValue . '</p>  ';
		}
		return $content;
	}

}


?>
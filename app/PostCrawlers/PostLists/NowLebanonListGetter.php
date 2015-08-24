<?php 

namespace App\PostCrawlers\PostLists;

use SimplePie;
use App\PostCrawlers\PostDetails\NowLebanonDetailsGetter;
/**
* 
*/
class NowLebanonListGetter
{
	public function __construct($url, $crawler){
		$this->url = $url;
		$this->crawler = $crawler;
	}
	
	public function getList($howmany = 10){

		$links = [];

		$allLinks = $this->crawler->filter('#Content_Content_Content_PagedListControl_dvListing a');

		foreach ($allLinks as $key => $link) {
			
			$links[] = $link->getAttribute('href');

		}

		return $links;
	}
	
}

?>
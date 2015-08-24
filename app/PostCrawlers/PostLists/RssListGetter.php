<?php 

namespace App\PostCrawlers\PostLists;

use Carbon\Carbon;

/**
* 
*/
class RssListGetter
{
	
	public function __construct($feed){
		$this->feed = $feed;
	}

	public function getList($howmany = 10){

		$links = [];

		$collection = $this->feed->get_items(0,$howmany);

		foreach ($collection as $key => $link) {
			$links[] = finalUrl($link->get_permalink());
		}

		return $links;
	}

}

?>
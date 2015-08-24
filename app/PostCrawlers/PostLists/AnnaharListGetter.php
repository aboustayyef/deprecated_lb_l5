<?php 

namespace App\PostCrawlers\PostLists;

use SimplePie;
use App\PostCrawlers\PostDetails\NowLebanonDetailsGetter;
/**
* http://newspaper.annahar.com/article/257907-%D8%B9%D9%88%D9%86-%D9%84%D8%A7-%D8%B1%D8%A6%D8%A7%D8%B3%D8%A9-%D9%88%D9%84%D8%A7-%D9%82%D9%8A%D8%A7%D8%AF%D8%A9
*/
class AnnaharListGetter
{
	public function __construct($url, $crawler){
		$this->url = $url;
		$this->crawler = $crawler;
	}
	
		public function getList($howmany = 10){
		
		// results array
		$list = [];
		
		// xpath to all links on authors' pages
		$links = $this->crawler->filterXPath('//*[@id="site"]/section[2]/section[2]/section/ul/li[*]/article/h2/a');
		
		// prepare variables
		$url = "";
		$title = "";

		foreach ($links as $key => $link) {

			// if the link or title are identitcal to previous entry, skip
			
			if ( ($link->getAttribute('href') == $url) || ($link->nodeValue == $title) ) {
				continue;
			}
			$url = $link->getAttribute('href'); 
            $title = $link->nodeValue;   

            $url = arabicUrlEncode('http://newspaper.annahar.com' . $url);
            $list[] = $url;
            
            if ($key > $howmany) {
            	break;
            }
        }

        return $list;

	}
	
}

?>
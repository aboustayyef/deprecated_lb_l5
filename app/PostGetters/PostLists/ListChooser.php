<?php 

namespace App\PostGetters\PostLists;

use SimplePie;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

/**
 * 
* Chooses which getter to use based on whether or not there's an RSS feed
* 
* If There's an RSS feed, instantiate a simplePie $feed object and construct an RssListGetter with it
*
* Otherwise, instantiate a DomCrawler $crawler object and then select which web getter to use based on URL
* 
*/

class ListChooser
{

	protected $url, $rss, $crawler, $feed;

	public function __construct($url = null, $rss = null){
		
		$this->url = $url;
		$this->rss = $rss;

		if (!isset($rss) || $rss == "") {
			$this->crawler = new Crawler;
			$this->crawler->addHtmlContent(@file_get_contents($url));
		} else {
			$this->feed = new SimplePie(); // We'll process this feed with all of the default options.
		    $this->feed->set_feed_url($this->rss); // Set which feed to process.
		    $this->feed->set_useragent('Lebanese Blogs/3.2 (+http://www.lebaneseblogs.com)');
		    $this->feed->strip_htmltags(false);
		    $this->feed->enable_cache(false);
		    $this->feed->init(); // Run SimplePie.
		    $this->feed->handle_content_type(); // This makes sure that the content is sent to
		}
	}

	public function getList(){

		// RSS
		if (isset($this->rss) && $this->rss != "") {
			$getter = new RssListGetter($this->feed);
			return $getter->getList();
		}

		// Now Lebanon
		if (starts_with($this->url, 'https://now.mmedia.me')) {
			$getter = new NowLebanonListGetter($this->url, $this->crawler);
			return $getter->getList();
		}
	
	}
	
}

?>
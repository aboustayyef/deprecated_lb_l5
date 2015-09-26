<?php 

namespace App\PostCrawlers\PostLists;

use SimplePie;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

use App\Source;

class PostListGetter
{
	
	private $source;

	public function __construct(Source $source)
	{
		$this->source = $source;
	}

	public function getList(){

		// if post doesn't have rss feed
		if (empty($this->source->rss_feed)) {
			return $this->getListFromMedia();
		}

		return $this->getListFromRss();
	}


	public function getListFromMedia(){
		$crawler = new Crawler;
		$crawler->addHtmlContent(@file_get_contents($this->source->url));
		$getterClassName = 'App\PostCrawlers\PostLists\\' . $this->source->media_parent . 'ListGetter'; // example, NowLebanonListGetter, which implements now lebanon's way of getting lists;
		$getter = new $getterClassName($this->source->url, $crawler);
		return $getter->getList();
	}

	public function getListFromRss(){
		$feed = new SimplePie(); // We'll process this feed with all of the default options.
	    $feed->set_feed_url($this->source->rss_feed); // Set which feed to process.
	    $feed->set_useragent('Lebanese Blogs/3.2 (+http://www.lebaneseblogs.com)');
	    $feed->strip_htmltags(false);
	    $feed->enable_cache(false);
	    $feed->force_feed(true);
	    $feed->init(); // Run SimplePie.
	    $feed->handle_content_type(); // This makes sure that the content is sent to
	    $getter = new RssListGetter($feed);
		return $getter->getList();

	}
}

?>
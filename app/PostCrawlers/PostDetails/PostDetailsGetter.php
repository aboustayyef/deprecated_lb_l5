<?php 

Namespace App\PostCrawlers\PostDetails;

use App\Source;
use Symfony\Component\DomCrawler\Crawler;
use SimplePie;

class PostDetailsGetter
{

	protected $url, $source;
	
	function __construct(Source $source, $url)
	{
		$this->source = $source;
		$this->url = $url;
	}

	public function getDetails(){

		// if post doesn't have rss feed
		if (empty($this->source->rss_feed)) {
			return $this->getDetailsFromMedia();
		}

		// otherwise
		return $this->getDetailsFromRss();
	}

	public function getDetailsFromRss(){
			$feed = new SimplePie(); // We'll process this feed with all of the default options.
		    $feed->set_feed_url($this->source->rss_feed); // Set which feed to process.
		    $feed->set_useragent('Lebanese Blogs/3.2 (+http://www.lebaneseblogs.com)');
		    $feed->strip_htmltags(false);
		    $feed->enable_cache(false);
		    $feed->force_feed(true);
		    $feed->init(); // Run SimplePie.
		    $feed->handle_content_type(); // This makes sure that the content is sent to
		    $getter = new RssDetailsGetter($this->url, $feed);
			return $getter->getDetails();
	}

	public function getDetailsFromMedia(){

		$crawler = new Crawler;
		$htmlContent = @file_get_contents($this->url);
		$crawler->addHtmlContent($htmlContent);

		$getterClassName = 'App\PostCrawlers\PostDetails\\' . $this->source->media_parent . 'DetailsGetter';
		$getter = new $getterClassName($this->url, $crawler);
		return $getter->getDetails();
	}
}
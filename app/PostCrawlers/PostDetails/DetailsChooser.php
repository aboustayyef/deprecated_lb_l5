<?php 

Namespace App\PostCrawlers\PostDetails;

use Symfony\Component\DomCrawler\Crawler;
use SimplePie;

/**
 * 
* Chooses which details getter to use based on whether or not there's an RSS feed
* 
* If There's an RSS feed, instantiate a simplePie $feed object and construct an RssDetailsGetter with it
*
* Otherwise, instantiate a DomCrawler $crawler object and then select which web details getter to use by a magically created class from media parent name
* 
*/

class DetailsChooser
{
	
	protected $url, $rss, $crawler, $feed, $media_parent, $verbose;

	
	public function __construct($url = null, $rss = null, $media_parent = null,  $verbose = false){
		
		$this->url = $url;
		$this->rss = $rss;
		$this->media_parent = $media_parent;
		$this->verbose = $verbose;

		// echo "Verbose: $verbose, URL: $url, $rss: RSS" . PHP_EOL;

		if (!isset($rss) || $rss == "") {
			
			$this->crawler = new Crawler;

			$htmlContent = @file_get_contents($url);
			$this->crawler->addHtmlContent($htmlContent);
		
		} else {

			if ($this->verbose) {
				echo PHP_EOL . "*** RSS is set, Creating SimplePie Object" . PHP_EOL;
			}

			$this->feed = new SimplePie(); // We'll process this feed with all of the default options.
		    $this->feed->set_feed_url($this->url); // Set which feed to process.
		    $this->feed->set_useragent('Lebanese Blogs/3.2 (+http://www.lebaneseblogs.com)');
		    $this->feed->strip_htmltags(false);
		    $this->feed->enable_cache(false);
		    $this->feed->init(); // Run SimplePie.
		    $this->feed->handle_content_type(); // This makes sure that the content is sent to
		
			if ($this->verbose) {
				echo "*** SimplePie Created. Added HTML content " . PHP_EOL;
			}

		}
	}

	public function getDetails(){
		// RSS
		if (isset($this->rss) && $this->rss != "") {

			if ($this->verbose) {
				echo "*** Creating RssDetailsGetter object with $this->url and $this->feed " . PHP_EOL;
			}

			$getter = new RssDetailsGetter($this->url, $this->feed, $this->verbose);
			return $getter->getDetails();
		}

		// Otherwise, use magical class naming to get specific class
		
		$getterClassName = 'App\PostCrawlers\PostDetails\\' . $this->media_parent . 'DetailsGetter'; // example, NowLebanonDetailsGetter, which implements Now lebanon's way of getting lists;
		$getter = new $getterClassName($this->url, $this->crawler, $this->verbose);
		return $getter->getDetails();

	}

}


?>
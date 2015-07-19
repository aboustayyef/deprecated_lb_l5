<?php

namespace App\Utilities;

use Symfony\Component\CssSelector\CssSelector;
use Symfony\Component\DomCrawler\Crawler;

/**
* 
*/



class Scraper
{

	protected $url, $crawler;
    
    public function __construct($url)
    {
        $this->crawler = new Crawler();

        if ($html = @file_get_contents($url)) {
        	$this->crawler->addHtmlContent($html);
        }else{
        	$this->crawler = false;
        }
        return true;
    }

    public function getFromSelectors($selectors){
    	return $this->crawler->filter($selectors);
    }


}

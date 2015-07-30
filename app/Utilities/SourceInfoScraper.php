<?php

namespace App\Utilities;

/**
* returns information about a blog
* ---------------------------------------------------------------------------
* tite: The Title of the blog
* Rss: The RSS feed of the blog
*/

class SourceInfoScraper extends Scraper 
{ 

    // from parent: Crawler $crawler object;
    
    public $rss, $title, $description, $twitter;

    function __construct($url, $twitter = null)
    {
        parent::__construct($url);
        $this->twitter = $twitter;

        $this->title = $this->crawler->filter('title')->first()->text();
        $this->rss = $this->crawler->filter('link[type="application/rss+xml"]')->first()->attr('href');

        if ($twitter) {
            $twitterInfo = new twitterAccountScraper($twitter);
            $this->description = $twitterInfo->description();
            $this->image = $twitterInfo->profilePic();
        }


    }
}

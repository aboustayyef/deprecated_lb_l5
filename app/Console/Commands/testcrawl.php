<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use Cache;

class testcrawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('test crawling');
        $crawler = new Crawler;
        $crawler->addHtmlContent(Cache::get('annaharHtmlContent'));
        $links = $crawler->filterXPath('//*[@id="site"]/section[2]/section[2]/section/ul/li[*]/article/h2/a');
        foreach ($links as $key => $link) {
            var_dump($link->getAttribute('href')); 
            var_dump($link->nodeValue);           
        }
    }
}

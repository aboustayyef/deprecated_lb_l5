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
        $links = $crawler->filter('#site > section.page > section.rightColumn.categoryPage.science > section > ul > li');
        foreach ($links as $key => $link) {
            $as = new Crawler($link);
            foreach ($as->filter('a') as $key => $a) {
                if (!empty($a->nodeValue)) {
                    var_dump($a->getAttribute('href'));
                }
                
            };
            
        }
    }
}

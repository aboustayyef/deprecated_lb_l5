<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Source;
use App\Post;
use Exception;

class PostsGetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:get {shorthand? : The shorthand of the source, optional}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets the Latest Posts by sources. Supports all sources or specific sources';

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

        // If a shorthand is given

        if ($this->argument('shorthand')) {
            $this->getPostsFromSource($this->argument('shorthand'));            
        }


    }

    public function getPostsFromSource($source){

        $this->info("Getting posts from [ " . $source . " ]");

        // Check if it's a valid source
        
        if (!Source::has($source)) {
            throw new Exception("Given Shorthand is not for a valid source", 1);
        }

        // If exists, proceed
        
        $source = Source::where('shorthand', $source)->first();

        // get post links
        
        $postLinks = $source->crawlLatestPosts();
        
        // get details for links

        foreach ($postLinks as $key => $link) {
            $this->info('Getting details for link: ' . $link);

            $details = $source->crawlPostDetails($link, $verbose = false);

            // if Post::has($details), skip
            // otherwise, 
            //  1- Post::store($details) (without image)
            //  2- Cache Image and Store in Image model, with post ID;

            var_dump($details);
        }
    }

}

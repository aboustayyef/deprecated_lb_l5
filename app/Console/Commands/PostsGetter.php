<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Source;
use App\Post;
use Exception;
use App\PostCrawlers\PostLists\PostListGetter;
use App\PostCrawlers\PostDetails\PostDetailsGetter;
use Illuminate\Foundation\Bus\DispatchesJobs;

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
            return;          
        }

        // else

        $sources = Source::all();

        foreach ($sources as $key => $source) {
            try {
                $this->getPostsFromSource($source->shorthand);
            } catch (Exception $e) {
                $this->error('There was a problem with source [ ' . $source->description . ' ]');
            }
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
        $postLinks = (new PostListGetter($source))->getList();
        
        // get details for each link
        foreach ($postLinks as $key => $link) {

            $this->info('Getting details for link: ' . $link);

            $details = (new PostDetailsGetter($source, $link))->getDetails();

            if (! $source->hasPublished($details['url'])) {
                // save
                // associate to channel
                // queue image for processing
                // save the post
                $post = Post::create($details);
                
                // associate the post to a source
                $post->source()->associate($source)->save();

                // associate the post to channel(s)
                $post->channels()->sync($source->channels);

                // extract and process images (if any);
                (new \App\ContentProcessors\ImageProcessors\MainProcessor($post))->process();

                // process text
                (new \App\ContentProcessors\TextProcessors\MainProcessor($post))->process();

                } 
                else 
                {
                    $this->info('This post is already in the database');
                }

            // if Post::has($details), skip
            // otherwise, 
            //  1- Post::store($details) (without image)
            //  2- Cache Image and Store in Image model, with post ID;

        }
    }

}

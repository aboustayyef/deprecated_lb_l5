<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;

class ScoresUpdater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:getScores {hours? : number of hours back}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the social media scores for posts';

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

        $hours = $this->argument('hours') ? $this->argument('hours') : 12;

        $timeAgo = (new \Carbon\Carbon)->subHours($hours);
        $posts = Post::where('publishing_date', '>' , $timeAgo)->get();
        $this->comment('found ' . $posts->count() . ' posts in this timeframe');
        foreach ($posts as $key => $post) {
            $this->info('getting scores for [ ' . $post->url . ' ]');
            $post->getScores();
        }
    }
}

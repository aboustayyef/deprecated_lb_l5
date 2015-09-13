<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Post;
use App\Image;
use Illuminate\Contracts\Bus\SelfHandling;

class processPostImage extends Job implements SelfHandling
{
    protected $post, $imageUrl;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post, $imageUrl)
    {
        $this->post = $post;
        $this->imageUrl = $imageUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $image = Image::create([
            'url'   => $this->imageUrl,
            'height'   => 500,
            'width'     => 500
        ]);
        $image->post()->associate($this->post)->save();
    }
}

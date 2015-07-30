<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use App\Utilities\TwitterAccountScraper;
use Imagick;

class processTwitterThumbs extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        // get the twitter username
        $twitterUsername = $request->author_twitter;
        
        // get url of profile pic
        $twitterClient = new TwitterAccountScraper($twitterUsername);
        $imgUrl = $twitterClient->profilePic();

        // prepare file name
        $filename = $request->shorthand . '.jpg'; // example: beirutspring.jpg

        // manipulate image    
        $image = new Imagick($imgUrl);
        $image = $image->flattenImages(); // flatten
        $image->setFormat('JPEG'); // convert to jpeg
        $image->cropThumbnailImage(200,200); // resize & crop
        
        // save to final destination
        $outFile =  public_path() . '/img/thumbs/' . $filename;
        $image->writeImage($outFile);

    }
}

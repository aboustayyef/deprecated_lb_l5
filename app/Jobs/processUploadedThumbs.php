<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

use Imagick;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class processUploadedThumbs extends Job implements SelfHandling
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
        // get the uploaded file
        $fileObject = $request->file('thumb');
        
        // put in processing folder
        $filename = $request->shorthand . '.jpg'; // example: beirutspring.jpg
        $directory = public_path() . '/img/thumbs/originals/';
        $fileObject->move($directory, $filename);

        // manipulate image    
        $image = new Imagick($directory.$filename);
        $image = $image->flattenImages(); // flatten
        $image->setFormat('JPEG'); // convert to jpeg
        $image->cropThumbnailImage(200,200); // resize & crop
        
        // save to final destination
        $outFile =  public_path() . '/img/thumbs/' . $filename;
        $image->writeImage($outFile);

    }
}

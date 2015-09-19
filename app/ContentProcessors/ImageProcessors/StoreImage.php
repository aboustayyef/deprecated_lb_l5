<?php 

namespace App\ContentProcessors\ImageProcessors;

use App\Image;
use Aboustayyef\ImageExtractor;

class StoreImage extends _Processor
{
	
	public function process(){

        // get image, 
        $imageUrl = (new ImageExtractor($this->post->url))->get(400);

        if ($imageUrl) {
            // Store Image (using stubs. Replace later)
            $image = Image::create([
                'url'   => $imageUrl,
                'height'   => 500,
                'width'     => 500
            ]);
        
            // Associate it with post
            $image->post()->associate($this->post)->save();

            return true;
        }

        return false;

	}

}

 ?>
<?php 

namespace App\ContentProcessors\ImageProcessors;

use App\Image;

class StoreImage extends _Processor
{
	
	public function process($imageResource = null, $imageUrl = null){

            $image = Image::create([
                'url'   => $imageUrl,
                'height'   => $imageResource->height(),
                'width'     => $imageResource->width()
            ]);
        
            // Associate it with post
            $image->post()->associate($this->post)->save();

	}

}

 ?>
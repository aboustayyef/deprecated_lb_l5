<?php 

namespace App\ContentProcessors\ImageProcessors;

use App\Image;

class StoreImage extends _Processor
{
	
	public function process(){

		// Store Image (using stubs. Replace later)
		$image = Image::create([
            'url'   => $this->imageUrl,
            'height'   => 500,
            'width'     => 500
        ]);
        
        // Associate it with post
        $image->post()->associate($this->post)->save();
	}

}

 ?>
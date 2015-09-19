<?php 

namespace App\ContentProcessors\ImageProcessors;

use App\Image;

class CacheImage extends _Processor
{
	
	public function process(){

		// Caching logic
        Echo 'Image Cached into ' . md5($this->post->images[0]->url) . '.jpg' . PHP_EOL ;   
	}

}

 ?>
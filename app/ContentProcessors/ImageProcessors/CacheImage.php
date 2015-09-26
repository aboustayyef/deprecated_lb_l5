<?php 

namespace App\ContentProcessors\ImageProcessors;

use App\Image;

class CacheImage extends _Processor
{
	
	public function process($imageResource = null, $imageUrl = null){

		$imageResource->resize(400, null, function ($constraint) {
		    $constraint->aspectRatio();
		});  

		$imageResource->encode('jpg')->save('public/img/post_images/' . md5($this->post->image->url) . '.jpg');
	}

}

 ?>
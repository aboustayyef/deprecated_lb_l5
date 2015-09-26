<?php 

namespace App\ContentProcessors\ImageProcessors;

use Aboustayyef\ImageExtractor;
use App\Post;

/**
* 
*/
class MainProcessor extends _Processor
{

    public function process($imageResource = null, $imageUrl = null){

    	// Check if post has a suitable image
        try {
            $imageUrl = (new ImageExtractor($this->post->url))->get(399);
        } catch (\Exception $e) {
            $imageUrl = (new ImageExtractor($this->post->url, $this->post->content))->get(399);
        }
    	

    	if ($imageUrl) {

    		$imageResource = \ImageHandler::make($imageUrl);

    		// store it
			(new StoreImage($this->post))->process($imageResource, $imageUrl);

    		// cache it
    		(new CacheImage($this->post))->process($imageResource);
    	}

    }


}

?>
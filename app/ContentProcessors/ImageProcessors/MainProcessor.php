<?php 

namespace App\ContentProcessors\ImageProcessors;

use App\Post;

/**
* 
*/
class MainProcessor extends _Processor
{

    public function process(){

    	// Save the Image
    	(new StoreImage($this->post, $this->imageUrl))->process();

    	// Cache it
    	(new CacheImage($this->post, $this->imageUrl))->process();

    }


}

?>
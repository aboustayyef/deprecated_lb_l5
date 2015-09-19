<?php 

namespace App\ContentProcessors\ImageProcessors;

use App\Post;

/**
* 
*/
class MainProcessor extends _Processor
{

    public function process(){

    	// Find and Save the Image
    	$imageExists = (new StoreImage($this->post))->process();

    	if ($imageExists) {
    		(new CacheImage($this->post))->process();
    	}
    }


}

?>
<?php 

namespace App\ContentProcessors\TextProcessors;

use App\Post;

/**
* 
*/
class MainProcessor extends _Processor
{

    public function process(){

            // remove image tags, empty tags, Script tags, style tags.
            (new ScrubText($this->post))->process();

    		// get excerpt
			(new ExcerptText($this->post))->process();

    		// extract ratings
    		(new GetRatings($this->post))->process();
    	}

}

?>
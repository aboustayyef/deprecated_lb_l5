<?php 

namespace App\ContentProcessors\ImageProcessors;
use App\Post;
use App\Image;
abstract class _Processor
{
	
	protected $post, $imageUrl;
    
    public function __construct(Post $post, $imageUrl)
    {
        $this->post = $post;
        $this->imageUrl = $imageUrl;
    }

    abstract function process();

}


?>
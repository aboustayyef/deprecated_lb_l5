<?php 

namespace App\ContentProcessors\ImageProcessors;
use App\Post;
use App\Image;

Abstract class _Processor

{
	
	protected $post;
    
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    abstract function process();

}


?>
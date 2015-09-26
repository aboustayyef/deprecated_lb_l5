<?php 

namespace App\ContentProcessors\TextProcessors;
use App\Post;

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
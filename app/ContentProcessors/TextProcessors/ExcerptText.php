<?php 

namespace App\ContentProcessors\TextProcessors;

use Aboustayyef\Summarizer;

class ExcerptText extends _Processor
{
	
	public function process(){
			
			$summarizer = new Summarizer;
			$summarizer->text = $this->post->content;
			$this->post->excerpt = $summarizer->summarize(3);
			$this->post->save();

	}

}

 ?>
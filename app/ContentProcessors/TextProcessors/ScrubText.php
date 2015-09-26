<?php 

namespace App\ContentProcessors\TextProcessors;

class ScrubText extends _Processor
{
	
	public function process(){
			
			$text = $this->post->content;

			$junkTags= [
				"style", "form", "iframe", "script", "button", "input", "textarea", 
		        "noscript", "select", "option", "object", "applet", "basefont",
		        "bgsound", "blink", "canvas", "command", "menu", "nav", "datalist",
		        "embed", "frame", "frameset", "keygen", "label", "marquee", "link"
	        ];

	        // remove the junk tags
	        foreach ($junkTags as $key => $tag) {
	        	$text = $this->removeJunkTag($tag, $text);
	        }

	        // remove empty tags
	        $text = preg_replace("#<\\s*\\w+\\s*>\\s*<\\s*/\\s*\\w+\\s*>#um", " ", $text);

	        // remove extra white spaces
	        $text = preg_replace("#\\s+#um", " ", $text);

	        $this->post->content = $text;
	        $this->post->save();


	}



	public function removeJunkTag($tag, $text){
		return preg_replace("#<\\s*$tag\\s*>.*<\\s*/\\s*$tag\\s*>#um", " ", $text);
	}


}

 ?>
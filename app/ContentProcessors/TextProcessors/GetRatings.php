<?php 

namespace App\ContentProcessors\TextProcessors;

use Symfony\Component\DomCrawler\Crawler ;

class GetRatings extends _Processor
{
	
	public function process(){

			// NGNO rating info is not in body of post, get from DOM
			if ($this->post->source->shorthand == 'nogarlicnoonions') {
		      $content = @file_get_contents($this->post->url);
		    } else {
		      $content = strip_tags($this->post->content);
		    }
		
		if ($rating = $this->getRating($content)) {
			$this->post->star_rating = $rating;
			$this->post->save();
		}

	}

 	public function getRating($content){

    	switch ($this->post->source->shorthand) {

      	case 'nogarlicnoonions':
        	return $this->getNgnoRating($content);
        break;

	    case 'nadsreviews':
     	   return $this->getNadsRating($content);
        break;

	    default:
     	   return $this->getRatioRating($content);
        break;
    }
  }


  public function getRatioRating($content){
      preg_match('#(r|R)ating\s*:\s*(\d+(\.5)?)/(\d+)#', $content, $result);
      if (is_array($result) && (count($result) >= 4) ) {
        $numerator = $result[2];
        $denominator = $result[4];

        $rating = round(($numerator / $denominator) * 10) / 2;

        return $rating;
      } else {
        return false;
      }
  }

  public function getNgnoRating($content){
    $crawler = new Crawler($content);
    $ratingCrawler = $crawler->filter('.rating-result');
    if ($ratingCrawler->count() == 0) {
      return false;
    } else {
      $onOnions = $ratingCrawler->filter('img[src="/img/onion_on.png"]')->count();
      $rating = $onOnions / 2;
      return $rating;
    }
  }

  public function getNadsRating($content){
    preg_match('#\s+(R|r)ating.*((A|B|C)(\+|-)?)#', $content, $result);
    if (is_array($result) && (count($result) >= 3) ) {
        $score = $result[2]; //A+ 5, A 4.5, A- 4, B+ 3.5, B 3, B- 2.5, C+2, C 1.5, C- 1;
        $equivalence = [
          'A+' => 5,
          'A' => 4.5,
          'A-' => 4,
          'B+' => 3.5,
          'B'  => 3,
          'B-' => 2.5,
          'C+' => 2,
          'C'  =>1.5,
          'C-' =>1 ];
          $rating = $equivalence[$score];
        return $rating;
    } else{
      return false;
    }
  }


}

 ?>
<?php 

namespace App\Helpers;

use App\Post;
use App\Helpers\Socialworth;
use App\Score;
/**
* Calculates and saves the social media scores of a post 
*/

class ScoresGetter
{
	protected $post;
	
	function __construct(Post $post)
	{
		$this->post = $post;
	}

	public function get(){
		$instance = new Socialworth($this->post->url);
		$results = $instance->all(); // {'total': totalscore, 'facebook': facebookscore , 'twitter': twitterscore}

		// for calculating virality, create totalshares that gives more weight to twitter
      	$totalShares = round((($results->facebook + (2 * $results->twitter)) / 3 ) * 2 );

		$score = Score::create([
			'twitter' => $results->twitter,
			'facebook' => $results->facebook,
			'total' => $results->facebook + $results->twitter,
			'virality' => $totalShares > 1 ? round( 8 * log($totalShares) ) : 2 
			]
		);

		// save the score
		$score->save();
		
		// associate to
		$this->post->scores()->save($score);
	}

}


 ?>
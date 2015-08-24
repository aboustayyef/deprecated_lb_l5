<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

	public static function has($url){


		// Check to see if a post exists with the given url (watch http vs https);
		// Post::where('url', $url )->count() > 0;
		// test with glamroz / jed / 


	}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Channel;
use \Cache;
use \Session;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($channel = null)
    {
        if (is_null($channel)) {
            $posts = Post::getCache();
            if ($posts) {
                return view('app.posts')->with(['posts' => $posts[0] , 'channel' => null]);
            }
            return \Response::make("Sorry, no posts found", 503);
            
        }
        
        // If a channel is included
        // check if channel exists

        if (! Channel::exists($channel)) {
            return \Response::make('Sorry, this Channel does not exist', 404);
        }

        // if channel exists
        // we use the chunked cache of the latest 200 posts

        $posts = Post::getCache($channel);
        if ($posts) {
            return view('app.posts')->with(['posts' => $posts[0] , 'channel' => $channel]);
        }

        return \Response::make("Sorry, no posts found", 503);

    }

}

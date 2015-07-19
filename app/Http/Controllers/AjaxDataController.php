<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Utilities\BlogInfoScraper;

class AjaxDataController extends Controller
{
    function getInfo(Request $request){

    	$bloginfo = new BlogInfoScraper($request->url, $request->author_twitter);
    	return response()->json($bloginfo);
    }
}

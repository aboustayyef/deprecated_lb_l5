<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Utilities\SourceInfoScraper;

class AjaxDataController extends Controller
{
    function getInfo(Request $request){

    	$sourceinfo = new SourceInfoScraper($request->url, $request->author_twitter);
    	return response()->json($sourceinfo);
    }
}

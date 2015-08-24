<?php 

/**
 * Convenience function to combine functions below
 */

function finalUrl($url){
	
	// This function should only works for google proxy feeds
	if (!str_contains($url, 'feedproxy.google.com')) {
		return $url;
	}

	// redirect
	$url = redirectUrl($url);
	
	// cleanup 
	$url = cleanupUrl($url);

	// return result
	return $url;
}


/**
 * Redirects urls
 * @param  (string) $url the imput url
 * @return (string)      The output url
 * @author http://stackoverflow.com/questions/3799134/how-to-get-final-url-after-following-http-redirections-in-pure-php
 */

function redirectUrl($url) {

    stream_context_set_default(array(
        'http' => array(
            'method' => 'HEAD'
        )
    ));
    $headers = get_headers($url, 1);
    if ($headers !== false && isset($headers['Location'])) {
        return $headers['Location'];
    }
    return false;
}


/**
 * Cleans up the url
 * @param  [string] $url [input url]
 * @return [string]      [return url]
 */

function cleanupUrl($url){
	
	// remove utm queries, typically included by feedburner or other SEO tools;
	$url = preg_replace( '/(&|\?)?utm_.+?(&|$)$/', '', $url );

	// return result
	return $url;
}

/**
 * Encodes urls with arabic parts at the end
 * @param  string $url [url input]
 * @return string      [encoded url output]
 */

function arabicUrlEncode($url){

	// only works if url contains arabic strings
	if (preg_match("~\p{Arabic}+~iu", $url)) {
		$parts = explode('/', $url);
		$arabicPart = array_pop($parts); // last item in the array
		$arabicPart = urlencode($arabicPart);
		$parts[] = $arabicPart;
		$url = implode('/', $parts);
	}

	return $url;

}

?>
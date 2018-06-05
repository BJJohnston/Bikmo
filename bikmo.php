<?php
//Get data from url
function get($url, $file){
	//Get content from url
	$string = file_get_contents($url);
	//open cache file in write mode
	$f = fopen($cache_file, 'w');
	//write
	fwrite($f, $string, strlen($string));
	//close
	fclose($f);
	//return data
	return $string
}

function read($path){
	//opens path
	$f = fopen($path, 'r');
	//creates buffer
	$buffer = '';
	//until not end of file
	while (!feof($f)) {
		//read data
		$buffer .= fread($f, 2048);

	}
	//close file
	fclose($f);
	//return data
	return $buffer;
}

//create cache file
$cache_file = '/cache.page.php';
//url to cache
$url = 'https://bikmo.com/about-us/our-ethos/';

//if the cache exists
if (file_exists($cache_file)){
	//and time has been 24 hours
	$time = (time() - fileatime($cache_file));
	if ($time < 3600 * 24) {
		//retrieve data
		$html = read($cache_file);
	} else {
		//create new cache
		$html = get($url, $cache_file);
	}
else{
	//if no cache create one
	$html = get($url, $cache_file);
}

}
//echo the data
echo $html;
//finish
exit;

?>
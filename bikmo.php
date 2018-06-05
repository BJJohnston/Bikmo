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

$cache_file = '/cache.page.php';
$url = 'https://bikmo.com/about-us/our-ethos/';


?>
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

?>
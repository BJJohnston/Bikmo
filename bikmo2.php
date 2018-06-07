
/*My code is not functional but I believe I understand the implementation we are trying to reach!
 When the client side wants to access something from the web server it sends a GET request in the HTTP headers including the content-type, cache-control etc
 The server reads the GET request and retrieves the resource from the server for the client. When sending the response back to the client it sends the resource in the body of the HTTP header.
 Along with the other headers I beleive what you have asked me to do here is cache the response so therefore in the cache-control header I've tried to manipulate this to save the response (this could be
 a image like I've tried to implement) for 24 hours. Along with the cache-control header we have the etag header and the expiry header which we can use to cache responses, I do believe the cache-control header overwrites the expiry header though. 

 Below I've tried to implement the middleware to do this. It should function by taking the request, creating the response and then sending that back to the client side. I've also tried to this by following the psr-7 and 15 standards and interfaces that come with these. 
I've tried many resources but cant seem to get the response I wanted from the apache server I have set up at home.*/


<html>
<h1>Test</h1>
<img src="cat.jpg">
</html>

<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;


class ResponseCache{

	public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next = null){
		 
			$response = $next($request, $response);
			if ($request->getMethod() != 'GET' || $response -> getStatusCode() != 200){
				return $response;
			}

			$max = 3600 * 24;
			$repsonse = $response->withAddedHeader('Cache-Control', 'max-age=' . $max);
		

		
		return $next($request, $response);
	}


}




?>

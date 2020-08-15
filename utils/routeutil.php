<?php

function AddRoute($uri, $httpmethod, $handler){
	$routeinfo = array('uri' => $uri, 'httpmethod' => $httpmethod, 'methodcallback' => $handler);
    add_action('rest_api_init', function() use(&$routeinfo) {
        register_rest_route('simpleredirect', $routeinfo['uri'], array(
    	    'methods' => $routeinfo['httpmethod'],
        	'callback' => $routeinfo['methodcallback'],
       ));
    });
}

?>
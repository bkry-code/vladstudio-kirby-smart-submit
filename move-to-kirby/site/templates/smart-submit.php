<?php 

	// detect handler from http referer
	$handler_name = a::last( array_filter( explode('/', server::get('http_referer'))));

	$handler_path = c::get('root.content').'/smart-submit/'.$handler_name.'.php';

	// check honeypot
	if (get('smart-submit-honeypot') && intval(get('smart-submit-honeypot')) < 2)
	{
		die('{"error":"'.(l::get('smart-submit-alarm') ?: 'Anti-spam alarm. Please try again.').'"}');
	}
	if (file_exists($handler_path))
	{
		require $handler_path;
	}
	else
	{
		die('{"error":"'.(l::get('smart-submit-missing-handler') ?: 'Error - handler not found. Please contact web site administrator for details.').'"}');
	}

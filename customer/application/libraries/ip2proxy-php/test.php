<?php

error_reporting(\E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';
function getUserIP()
{
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if(filter_var($client, FILTER_VALIDATE_IP))
	{
		$ip = $client;
	}
	elseif(filter_var($forward, FILTER_VALIDATE_IP))
	{
		$ip = $forward;
	}
	else
	{
		$ip = $remote;
	}

	return $ip;
}
// Lookup by local BIN database
$db = new \IP2Proxy\Database('data/PX11.SAMPLE.BIN', \IP2PROXY\Database::FILE_IO);
$records = $db->lookup(getUserIP(), \IP2PROXY\Database::ALL);
print_r($records);
exit;

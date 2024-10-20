<?php
 function curl_cmc()
 {
	$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
	$parameters = [
	  'start' => '1',
	  'limit' => '1',
	  'convert' => 'BNB'
	];
	$headers = [
	  'Accepts: application/json',
	  'X-CMC_PRO_API_KEY: ae410942-3984-47d1-8451-df62158d8985'
	];
	$qs = http_build_query($parameters); // query string encode the parameters
	$request = "{$url}?{$qs}"; // create the request URL
	
	
	$curl = curl_init(); // Get cURL resource
	// Set cURL options
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $request,            // set the request URL
	  CURLOPT_HTTPHEADER => $headers,     // set the headers 
	  CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
	));
	
	$response = curl_exec($curl); // Send the request, save the response
	print_r(json_decode($response)); // print json decoded response
	curl_close($curl); // Close request	 
 }
 


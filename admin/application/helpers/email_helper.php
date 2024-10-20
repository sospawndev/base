<?php
define('MULTIPART_BOUNDARY', '----'.md5(time()));
define('EOL',"\r\n");// PHP_EOL cannot be used for emails we need the CRFL '\r\n'

function getBodyPart($FORM_FIELD, $value) {
    if ($FORM_FIELD === 'attachment') {
        $content = 'Content-Disposition: form-data; name="'.$FORM_FIELD.'"; filename="'.basename($value).'"' . EOL;
        $content .= 'Content-Type: '.mime_content_type($value) . EOL;
        $content .= 'Content-Transfer-Encoding: binary' . EOL;
        $content .= EOL . file_get_contents($value) .EOL;
    } else {
        $content = 'Content-Disposition: form-data; name="' . $FORM_FIELD . '"' . EOL;
        $content .= EOL . $value . EOL;
    }

    return $content;
}

/*
 * Method to convert an associative array of parameters into the HTML body string
*/
function getBody($fields) {
    $content = '';
    foreach ($fields as $FORM_FIELD => $value) {
        $values = is_array($value) ? $value : array($value);
        foreach ($values as $v) {
            $content .= '--' . MULTIPART_BOUNDARY . EOL . getBodyPart($FORM_FIELD, $v);
        }
    }
    return $content . '--' . MULTIPART_BOUNDARY . '--'; // Email body should end with "--"
}

/*
 * Method to get the headers for a basic authentication with username and passowrd
*/
function getHeader($username, $password){
    // basic Authentication
    $auth = base64_encode("$username:$password");

    // Define the header
    return array('Authorization:Basic '.$auth, 'Content-Type: multipart/form-data ; boundary=' . MULTIPART_BOUNDARY );
}
function kirim_email($arr = array())
{
	// URL to the API that sends the email.
	$url = 'https://api.infobip.com/email/1/send';
	$c = "gatekbgt2@gmail.com";
	$from = 'Lewat Pasar <'.$c.'>';
	// Associate Array of the post parameters to be sent to the API
	$postData = array(
			'from' => $from,
			'to' => $arr['to'],
			'replyTo' => $c,
			'subject' => $arr['subject'],
			'text' => isset($arr['text'])?$arr['text']:'',
			'html' => isset($arr['html'])?$arr['html']:''
			 
		);
	if(isset($arr['attach']))
	{
		if(file_exists($arr['attach']['path']))
		{
			$postData["attachment"] = isset($arr['attach']['path'])?$arr['attach']['path']:"";
		}
	}
	  
	// Create the stream context.
	$context = stream_context_create(array(
		'http' => array(
			  'method' => 'POST',
			  'ignore_errors'=>true,
			  'header' => getHeader('lewatpasar', '123qweasd'),
			  'content' =>  getBody($postData),
		),
		'ssl' => array(
                "verify_peer"=>false,
                "verify_peer_name"=>false)
	));
	
	// Read the response using the Stream Context.
	$response = file_get_contents($url, false, $context);
	return $response;
}
 ?>

					
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class SmsPintar {
	public $auths = false;
	public $token = "";
	public function __construct() {
		
		$CI =& get_instance();
		 
		 

	}
	public function config()
	{
		$config = array();
		$config['username'] = 'SospawnWAOTP';
		$config['password'] = 'bTcGLxU9';
		$config['clientID'] = 'SO20230712153045';
		return $config;	
	}
	public function auth()
	{
		$url = "http://sms.sipintar.co.id:8081/api/oauth";
		$config = $this->config();
		$data = $this->post_curl($url,$config);	
		return $data;
	}
	public function send($number,$authcode)
	{
		$CI =& get_instance();
		//$CI->session->set_userdata('token_smspintar','');
		$tokens =  $CI->session->userdata('token_smspintar');
		if(empty($tokens))
		{
			 	
			 $auth = $this->auth();
			 if(!empty($auth))
			 {
				 $authdata = json_decode($auth,true);
				 if(isset($authdata['responseid']))
				 {
					 $this->token = $authdata['responseid'];
					 $CI->session->set_userdata('token_smspintar',$authdata['responseid']);
					 $tokens =  $CI->session->userdata('token_smspintar');
				 }			
			 }
		}
		 
		/*
		senderid: 'Zendz',
		  type: 'wa',
		  msisdn: '+628983337499',
		  encoding: 'GSM',
		  message: 'Kode verifikasi Zendz adalah 489559',
		  username: 'ZendzWAOTP',
		  password: 'eaT9GbM7',
		  token: 'e0331283fd6b4a89b71fc67760fb3f0f',
		  callbackurl: '',
		  callbackmethod: 'post'
		*/
		$configs = $this->config();
		$config = array();
		$config['senderid'] = "Sospawn";
		$config['type'] = "wa";
		$config['msisdn'] = $number;
		$config['encoding'] = "GSM";
		$config['message'] = "Your Verification Code ".$authcode;
		$config['messageType'] = "TEXT";
		$config['username'] = $configs['username'];
		$config['password'] = $configs['password'];
		$config['token'] = $tokens;
		$config['callbackurl'] = site_url('otp/callback');
		$config['callbackmethod'] = "post";
		 		
		$url = "http://sms.sipintar.co.id:8081/api/wa";
		/*print_r("Result: <br/>");
		print_r("Api: <br/>");
		print_r($url);
		print_r("<br/>");
		*/
		$data = $this->post_send($url,$config);	
		return $data;
	}
	public function post_x($url,$send)
	{
		$json = json_encode($send);
		$ch = curl_init($url);
 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $send);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($json),
			'Connection: Keep-Alive'
		));
		 
		$response = curl_exec($ch);
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
		curl_close($ch);
		if (200==$retcode) {
			return $response;
		} else {
			return false;// $retcode;
		}
	}
	public function post_send($url,$send)
	{
		$CI =& get_instance();
		//$send = http_build_query($send);
		$tokens =  $CI->session->userdata('token_smspintar'); 
		// Get cURL resource
		$headers = [
			'Accept: application/json',
			'Content-Type: application/json',
			'Connection: Keep-Alive',
			
			//'token:'.$tokens
		];

		
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		//curl_setopt($curl, CURLOPT_HEADER, 1);
		//curl_setopt($curl, CURLOPT_HEADER, 1);
		//curl_setopt($curl, CURLOPT_USERPWD, $send['username'] . ":" . $send['password']);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		//curl_setopt($curl, CURLOPT_HTTPHEADER,array("Expect:  "));
		 
		//curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			//CURLOPT_USERAGENT => 'mozilla firefox',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => json_encode($send)
		));
		// Send the request & save response to $resp
		 
		$resp = curl_exec($curl);
		$retcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		 
		// Close request to clear up some resources
		curl_close($curl);	
		//print_r($retcode);
		//exit;
		/*
		print_r("Data Send: <br/>");
		print_r(json_encode($send));
		print_r("<br/> Output:<br/>");
		*/
		if (200==$retcode) {
			return $resp;
		} else {
			return false;// $retcode;
		}
		 
	}
	public function post_curl($url,$send)
	{
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => 'mozilla firefox',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $send/*array(
				item1 => 'value',
				item2 => 'value2'
			)*/
		));
		// Send the request & save response to $resp
		
		$resp = curl_exec($curl);
		$retcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		// Close request to clear up some resources
		curl_close($curl);	
		//print_r($retcode);
		//exit;
		if (200==$retcode) {
			return $resp;
		} else {
			return false;// $retcode;
		}
		 
	}
	public function status_encode($entry)
	{
		$message['000'] = "MESSAGE SUCCESS AND DELIVERED";
		$message['001'] = "MESSAGE IS PENDING, TO BE SUBMITTED";
		$message['002'] = "MESSAGE IS SUBMITTED";
		$message['003'] = "MESSAGE IS BEING PROCESSED"; 
		$message['004'] = "MESSAGE IS WAITING FOR SCHEDULE"; 
		$message['005'] = "VOICE CALL IS INITIATED";
		$message['006'] = "VOICE CALL IS RINGING";
		$message['007'] = "VOICE CALL IS IN PROGRESS";
		$message['101'] = "VOICE CALL IS REJECTED/NOT ANSWERED (NF)";
		$message['102'] = "VOICE CALL IS REJECTED";
		$message['103'] = "VOICE CALL IS NOT ANSWERED";
		$message['104'] = "VOICE CALL IS FAILED FOR USER IS BUSY";
		return $message[$entry];
		 
	}
	 
	
}
?>
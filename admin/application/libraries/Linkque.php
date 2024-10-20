<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require __DIR__.'/linkqu-php/vendor/autoload.php';
use ZerosDev\LinkQu\Constant;
use ZerosDev\LinkQu\Client;
 
class Linkque
{
	var $CI;
	var $data;
	var $id_member = 0;
	var  $type = "production"; //"production"; //"development";
	var $signature;
	/**
	 * Constructor - Sets up the object properties.
	 */
	function __construct()
	{
		$this->CI = &get_instance();
	}
	function api_config($signs = "")
	{
		 $arr = array(); 
		 if($this->type=="development")
		 {
			
			 $arr['username'] = '';
			 $arr['pin'] = '';
			 $arr['client-id'] = 'testing';
			 $arr['client-secret'] = '123';
			 $arr['signature'] = !empty($this->signature)?$this->signature:'LinkQu@2020';			 
		 }
		 if($this->type=="production")
		 {
			 $arr['username'] = '';
			 $arr['pin'] = '';
			 $arr['client-id'] = '';
			 $arr['client-secret'] = '';
			 $arr['signature'] = 'LinkQu@2020';			 
		 }
		 return $arr;
	}
	function init($signs = "")
	{
		 
		  
		$this->signature = $signs;
		$linkqu = new Client(function ($client) {
		 
		$prop = $this->api_config($this->signature);
		 
		/*
		$client->setMode(Constant::DEVELOPMENT)
				->setClientId($prop['client-id'])
				->setClientSecret($prop['client-secret'])
				->setUsername($prop['username'])
				->setPin($prop['pin'])
				->setDebug(true);
		});
		*/	
		if(empty($this->signature))
		{
			$client->setMode($this->type)
					->setClientId($prop['client-id'])
					->setClientSecret($prop['client-secret'])
					->setUsername($prop['username'])
					->setPin($prop['pin'])
					->setDebug(true);
			
		}else
		{
			$client->setMode($this->type)
					->setClientId($prop['client-id'])
					->setClientSecret($prop['client-secret'])
					->setUsername($prop['username'])
					->setPin($prop['pin'])
					->setSignature($this->signature)
					->setDebug(true);
			 
		}
		});
		return $linkqu;
	}
	 
}
 
<?php

class Payment
{
	//----sandbox
	//secretkey: dcc9d0fb-787c-40b4-b3a0-d436f8a31ef8
	////api key
	// test_71d46ad531054925069f9f5cac41bbed
	// --end sandbox
	//live
	//secret_key::c837a964-4c8e-40b3-a1f6-dcc6b1d026e7
	//api key
	//live_71d46ad531054925069f9f5cac41bbed
	//end live
	
	//curl
	public static function key_sandbox()
	{
		$secretkey = "dcc9d0fb-787c-40b4-b3a0-d436f8a31ef8";
		$apikey = "test_71d46ad531054925069f9f5cac41bbed";		
		return array("apikey"=>$apikey,"secret_key"=>$secretkey);
	}
	public static function key_live()
	{
		$secretkey = "c837a964-4c8e-40b3-a1f6-dcc6b1d026e7";
		$apikey = "live_71d46ad531054925069f9f5cac41bbed";		
		return array("apikey"=>$apikey,"secret_key"=>$secretkey);
	}
	public static function get_urls($url)
	{
		$type = settings("type_payment");
		$api = Payment::key_sandbox();
		if($type!="sandbox")
		{
			$api = Payment::key_live();	
		}
		$headers = array(
			'Content-Type: application/json',
			'Authorization: Basic '. base64_encode($api['apikey'].":".$api['secret_key'])
		);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_USERPWD, $api['apikey'] . ":" . $api['secret_key']);  
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		//curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$resp = curl_exec($ch);
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		 
		
		if (200==$retcode) {
			return $resp;
		} 
		return "";
	}
	public static function post_curl($url,$send,$error=false)
	{
		// Get cURL resource
		$vsend = array("data"=>array());
		$vsend['data'] = array("attributes"=>$send); 
		//print_r(json_encode($vsend));
		//exit; 
		$type = settings("type_payment");
		$api = Payment::key_sandbox();
		if($type=="live")
		{
			$api = Payment::key_live();	
		}
		$headers = array(
			'content-type: application/vnd.api+json',
			'Authorization: Basic '. base64_encode($api['apikey'].":".$api['secret_key'])
		);
		
		
		$curl = curl_init();
		 
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => 'mozilla firefox',
			CURLOPT_POST => 1,
			CURLOPT_FOLLOWLOCATION=>1,
			CURLOPT_HTTPHEADER =>$headers,
			CURLOPT_USERPWD =>$api['apikey'] . ":" . $api['secret_key'],
			
			CURLOPT_POSTFIELDS => json_encode($vsend)
		));
		// Send the request & save response to $resp
		
		$resp = curl_exec($curl);
		$retcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		// Close request to clear up some resources
		curl_close($curl);	
		//print_r($resp);
		//exit;
		
		if($error==true)
		{
			return $resp;
		}
		 
		if (200==$retcode || 201==$retcode) {
			return $resp;
		} else {
			return false;
		}
		 
	}
	//bank exfers
	public static function bank_exfers()
	{
		$ci =& get_instance(); 
		$type = settings("type_payment");
		$v = Payment::get_urls("https://sandbox-id.xfers.com/api/v4/banks");
		if($type=="live")
		{
			$v = Payment::get_urls("https://id.xfers.com/api/v4/banks");
		}
		
		return $v;	
	}
	//Membuat Disbursement
	public static function add_disbursement($data = array()) {
	   $ci =& get_instance(); 	
	   $url = "https://sandbox-id.xfers.com/api/v4/disbursements";	
       $type = settings("type_payment");		
	   if($type=="live")
	   {
			 $url = "https://id.xfers.com/api/v4/disbursements";	
	   }
	  
	   if(!isset($data['disbursementMethod']['type']))
	   {
		   $data['disbursementMethod']['type'] = "bank_transfer";
	   }
	   $arr = Payment::post_curl($url,$data); 
	   return $arr;
	   /*
		   {
		"data": {
		  "attributes": {
			"amount": 10000,
			"referenceId": "order_id_123456",
			"description": "Your delivery payout.",
			"disbursementMethod": {
			  "type": "bank_transfer",
			  "bankShortCode": "BRI",
			  "bankAccountNo": "0102030405",
			  "bankAccountHolderName": "John Doe"
			}
		  }
		}
	  }
	   */
    } 
	//end
	//Task Disbursement
	public static function task_disbursement($contract_id, $data = array()) {
	   $ci =& get_instance(); 	
	   $url = "https://sandbox-id.xfers.com/api/v4/disbursements/".$contract_id."/tasks";	
	   $type = settings("type_payment");		
	   if($type=="live")
	   {
			 $url = "https://id.xfers.com/api/v4/disbursements/".$contract_id."/tasks";
	   }
	   $arr = Payment::post_curl($url,$data); 
	   return $arr;
	}
	
	
	//account balance
	public static function balance_exfers()
	{
		$ci =& get_instance(); 
		$type = settings("type_payment");
		$v = Payment::get_urls("https://sandbox-id.xfers.com/api/v4/overviews/balance_overview");
		if($type=="live")
		{
			$v = Payment::get_urls("https://id.xfers.com/api/v4/overviews/balance_overview");
		}
		
		return $v;	
	}
	//Bank Account Validation
	public static function validation_exfers($data=array() )
	{
		$ci =& get_instance(); 
		$type = settings("type_payment");
		  
	   $url = "https://sandbox-id.xfers.com/api/v4/validation_services/bank_account_validation";	
	   $type = settings("type_payment");		
	   if($type=="live")
	   {
			 $url = "https://id.xfers.com/api/v4/validation_services/bank_account_validation";
	   }
		
		
	   /*
	   {
		"data": {
		  "attributes": {
			"accountNo": "000501003219303",
			"bankShortCode": "BRI"
		  }
		}
	  }
	   */
	   $arr = Payment::post_curl($url,$data); 
	   return $arr;
	}
	//create_payment
	public static function create_payment($data = array()) {
	   $ci =& get_instance(); 
	   	
	   $url = "https://sandbox-id.xfers.com/api/v4/payments";	
	   $type = settings("type_payment");		
	   if($type=="live")
	   {
			 $url = "https://id.xfers.com/api/v4/payments";
	   }
	   /*
	    /// paymentMethodType "virtual_bank_account", "retail_outlet", and "qris"
	   ///
	   Toko Retail
	   "paymentMethodOptions": {
		  "retailOutletName": "ALFAMART"
		}
	   ///	
	   Virtual Account
	   ///
	   "paymentMethodOptions": {
		  "bankShortCode": "BNI", // choose bank to create the VA
		  "displayName": "test name",
		  "suffixNo": "12345678"
		}
		///	
	   QRIS
	   ///
	   "paymentMethodOptions": {
		  "displayName": "Your preferred name"
		}
		///QRIS
	   "paymentMethodType": "retail_outlet",
       "amount": 15000,
       "referenceId": "ORDER_0001",
       "expiredAt": "2020-10-06T06:07:04+07:00",
       "description": "Order Number 0001",
       "paymentMethodOptions": {
         "retailOutletName": "ALFAMART"
       }
	   
	   */
	   $arr = Payment::post_curl($url,$data); 
	   return $arr;
	}
	//payment_method
	public static function payment_method($no)
	{
		$ci =& get_instance(); 
		
		$v = array("virtual_bank_account", "retail_outlet", "qris");	
		return isset($v[$no])?$v[$no]:0;
	}
	//Task payment
	public static function task_payment($contract_id, $data = array()) {
	   $url = "https://sandbox-id.xfers.com/api/v4/payments/".$contract_id."/tasks";	
	   $type = settings("type_payment");		
	   if($type=="live")
	   {
			 $url = "https://id.xfers.com/api/v4/payments/".$contract_id."/tasks";
	   }
	   $arr = Payment::post_curl($url,$data); 
	   return $arr;
	}
	// task disburment
	//wajib
	public static function disburment_status() {
		$ci =& get_instance(); 
		
		$v = array("Waiting","Complete","Process","Failed");		
		return $v;
	}
	public static function disburment_status_get($no = 0) {
		$ci =& get_instance(); 
		
		$v = Payment::disburment_status();				
		return isset($v[$no])?$v[$no]:"";
	}
	public static function xfers_payment_method($data = array(),$error = false)
	{
		$ci =& get_instance(); 
		
		$urls = "https://sandbox-id.xfers.com/api/v4/payment_methods/virtual_bank_accounts";
		$type = settings("type_payment");		
		if($type=="live")
		{
			$url = "https://id.xfers.com/api/v4/payment_methods/virtual_bank_accounts";
		}	
		/*
		-d '
		  {
			"data": {
			  "attributes": {
				"referenceId": "customer_id_123456",
				"bankShortCode": "BRI",
				"displayName": "My Company Name",
				"suffixNo": "12345678"
			  }
			}
		  }
	   */
	   
	   $arr = Payment::post_curl($urls,$data,$error); 
	   return $arr;
	}
}

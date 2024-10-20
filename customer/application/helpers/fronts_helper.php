<?php
 
function get_unique_forgot_code($code)
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',5);
	$rs = $CI->db->where('email_telp',$code)->where('validation_code',$rand)->get('forgot');
	if($rs->num_rows()>0)
	{
		return get_unique_forgot_code($code);
	}
	return $rand;
}
function clear_forgot()
{
	$CI =& get_instance();
	$CI->db->trans_begin();
	$CI->db->where('email_telp',user_front('email'))->delete('forgot');	
	$CI->db->trans_commit();
}
#=== email
function emailsend($op = array(),$tipe ="register")
{
	 
	$c = settings(); 
	
	$CI =& get_instance();
		$subject=$CI->config->item('daftar_emailsubject');
		$config = Array(       
				'mailtype' => 'html',
				 'charset' => 'utf-8',
				 'priority' => '1'
		);
		$CI->load->library('email', $config);
		$CI->email->set_newline("\r\n");
	    $CI->email->from($c['email_from'], $c['email_from_title']);
		 
		$CI->email->to($op['email']);  // replace it with receiver mail id
		$CI->email->subject($c['email_title']); // replace it with relevant subject
		if($tipe=="register")
	    $op['email_content'] = str_replace("{code}",$op['verification_code'], $c['email_content']);
		if($tipe=="forgot")
		$op['email_content'] = str_replace("{code}",$op['forgot_code'], $c['email_content_forgot']);
		 
		$body = $CI->load->view('manager/emailtemplate.php',$op,TRUE);
		$CI->email->message($body);  
		$CI->email->send();	
}
function signature()
{
	$CI =& get_instance();
	$CI->load->library('device'); 
	$device = $CI->device->getinfo();
	$ip = getUserIP();
	$up = array();
	$up['ip_address'] = $ip;
	$up['os_info'] = $device['data']['os']['name']."".$device['data']['os']['version'];
	 
	$up['platform'] = $device['data']['device'];
	$up['model'] = $device['data']['model'];
	
	$regex = '/[^0-9a-zA-Z]/';
	$serverKey = "sospawn";
	$secondvalue = strtolower(preg_replace($regex, "", $up['ip_address'].$up['os_info'].$up['platform'].$up['model']));
    $signToString = $secondvalue;
    $signature = hash_hmac('sha256', $signToString , $serverKey);
	return $signature;	
}

function get_unique_wa()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',4);
	$rand = $rand;
	$rs = $CI->db->where('wa_code',$rand)->get('customer');
	if($rs->num_rows()>0)
	{
		return get_unique_wa();
	}
	return $rand;
}



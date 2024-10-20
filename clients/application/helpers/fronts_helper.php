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



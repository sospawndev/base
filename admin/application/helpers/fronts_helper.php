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
 
function get_customer($name = "")
{
	$CI =& get_instance();
	$data = $CI->db->where('id',user_front('id'))->get('customer')->row_array();
	return isset($data[$name])?$data[$name]:""; 
}
function settings($name = "")
{
	$CI =& get_instance();
	$data = $CI->db->get('setting')->row_array();
	return isset($data[$name])?$data[$name]:""; 
}


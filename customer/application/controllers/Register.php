<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		 parent::__construct();
		 return redirect("login"); 
	}
	public function index($ids = "")
	{
		 
		$in = array();
		 
		 
		$in['refs'] = $ids; 
		$in['title'] = "Logins";
		$this->load->view('manager/register',$in);
		return; 
	}
	 
	public function views($ids = "")
	{
		 
		$in = array();
		 
		 
		$in['refs'] = $ids; 
		$in['title'] = "Logins";
		$this->load->view('manager/register',$in);
		return; 
	}
	public function cek($ids = "")
	{
		 
		$in = array();
		 
		 
		$in['refs'] = $ids; 
		$in['title'] = "Logins";
		$this->load->view('manager/check_register',$in);
		return; 
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$this->load->library('device'); 
			$in = $this->input->post();
			$ip = getUserIP();
			$device = $this->device->getinfo();
			
			if($device['bot'])
			{
				json(array('error'=>true,'message'=>'<b>Bot Not Allowed</b>','security'=>token()));
				return;
			}
			if(!isset($device['data']['device']))
			{
				json(array('error'=>true,'message'=>'<b>Bot Not Allowed</b>','security'=>token()));
				return;
			}
			$get_device = $this->session->userdata('get_device');
			/*if(!empty($get_device))
			{
				json(array('error'=>true,'message'=>'For Security Reason, Register is Failed','security'=>token()));
				return;
			}*/
			$device_id = signature();
			if($get_device==$device_id)
			{
				json(array('error'=>true,'message'=>'For Security Reason, Register is Failed','security'=>token()));
				return;
			}
			
			$up = array();
			$up['ip_address'] = $ip;
			$up['os_info'] = $device['data']['os']['name']."".$device['data']['os']['version'];
			$up['device_id'] = $device_id;
			$up['platform'] = $device['data']['device'];
			$check_ip = $this->db
						->where('ip_address',$ip)
						->where('os_info',$up['os_info'])
						->where('platform',$up['platform'])
						 
						->where('type',0)->get('customer')->row_array();
			if(isset($check_ip['id']))
			{
				json(array('error'=>true,'message'=>"For Security Reason, Register is Failed","urlv"=>site_url('page-error/error_ip'),'security'=>token()));
				return;
					
			}
			/*$check_ip = $this->db
						->where('ip_address',$ip)
						->where('os_info',$up['os_info'])
						->where('platform',$up['platform'])
						->where('type',0)->get('customer')->row_array();
			if(isset($check_ip['id']))
			{
				json(array('error'=>true,'message'=>"For Security Reason, Register is Failed","urlv"=>site_url('page-error/error_ip'),'security'=>token()));
				return;
					
			}*/
			
			
			$cck = false;
			
			/*
			$check_ip = $this->db->where('ip_address',$ip)->where('type',0)->get('customer')->row_array();
			if(isset($check_ip['id']))
			{
				json(array('error'=>true,'message'=>"For Security Reason, Register is Failed","urlv"=>site_url('page-error/error_ip'),'security'=>token()));
				return;
					
			}
			*/
			
			
			if (strpos($in['email'], "gmail") !== false || strpos($in['email'], "yahoo") !== false) {
				//json(array('error'=>true,'message'=>custom_language('Use email only gmail and yahoo'),'security'=>token()));
				//return;	
				$cck = true;
			} 	
			if(!$cck)
			{
				json(array('error'=>true,'message'=>custom_language('Use email only gmail and yahoo'),'security'=>token()));
				return;
			}
			
			$time = time();
			$check = $this->db->where('email',$in['email'])->get('customer');
			if($check->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Email Exist','security'=>token()));
				return;	
			}
			//
			 
			//
			if(isset($in['refferal']))
			{
				if(!empty($in['refferal']))
				{
					/*
					$in['refferal'] = str_replace("A-","",$in['refferal']);
					$in['refferal'] = preg_replace("/[^0-9.]/", "", $in['refferal']);
					*/
					
					$refferal = str_replace("A-","",$in['refferal']);
					$refferal = preg_replace("/[^0-9.]/", "", $refferal);
					$check_ref = $this->db->where('pid',$refferal)->get('v_customer');
					unset($in['refferal']);
					if($check_ref->num_rows()>0)
					{
						$arr = $check_ref->row_array();
						$in['refferal'] = $arr['id'];
						
					}
				}
			}
			$in['ip_address'] = $ip;
			 
			$in['os_info'] = $device['data']['os']['name']."".$device['data']['os']['version'];
			$in['device_id'] = $device_id;
			$in['platform'] = $device['data']['device'];
						
			$up['os_info'] = $device['data']['os']['name']."".$device['data']['os']['version'];
			$up['device_id'] = $device_id;
			$up['platform'] = $device['data']['device'];
			
			$in['created_on'] = $time;
			$in['updated_on'] = $time;
			$in['activation_code'] = get_unique_customer_code();
			$in['passwords'] =  $this->encryption->encrypt($in['passwords']);
			 
		 
			
		
			$this->db->insert("customer",$in);
			$ids = $this->db->insert_id(); 
			//$in['urls'] = base_url()."stats/status/".$in['activation_code'];//site_url("stats/status/".$in['activation_code']);
			$in['urls'] = base_url()."stats/status/".$in['activation_code'];
			$this->session->set_userdata('sospawn_customer',$in);
			send_mail_link($in);
			json(array('error'=>false,'message'=>"Check your email inbox or spam, for confirmation email  </h5><br/> <a href='javascript:void(0);' class='resends btn btn-small btn-sm btn-xs btn-danger' style='float:right;' onclick='javascript:resendclick();'>Resend</a><br/>","urlv"=>site_url('register/cek/'.$ids),'security'=>token()));
			return;
		}
		show_404();
	}
	public function resend()
	{
		$in = $this->session->userdata('sospawn_customer');
		send_mail_link($in);
	}
	 
	 
	 
}


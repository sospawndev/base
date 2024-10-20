<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google extends CI_Controller {

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
		 
	}
	public function oaths()
	{
		if (isset($_GET['code'])) {
			
			$this->load->library('device'); 
			$device = $this->device->getinfo();
			if($device['bot'])
			{
				/*
				redirect('page-error/error_ip_check');
				return;
				*/		
			}
			if(!isset($device['data']['device']))
			{
				/*
				redirect('page-error/error_ip');
				return;	
				*/
			}
			$this->googleplus->getAuthenticate();
			$arr = $this->googleplus->getUserInfo();
			if(isset($arr['email']))
			{
				$check = $this->db->where('email',$arr['email'])->where('type',0)->get('customer')->row_array();
				if(isset($check['id']))
				{
					$block =  $this->db->where("( email = '".$arr['email']."')")->where("status=2")->where("type=0")->get('v_customer')->row_array();
					if(isset($block['id']))
					{
						redirect('page-error/blockeds/'.$check['id']);
						return;	
					}
					
					$get_user_login = $this->session->userdata('get_user_login');
					
					 
						$ip = getUserIP();
						$check_ip = $this->db
							->where("id<>'".$check['id']."'")
							->where('ip_address',$ip)->where('type',0)->get('customer')->row_array();
						if(isset($check_ip['id']))
						{
							/*
							redirect('page-error/error_ip_check');
							return;	
							*/
						}
					 
					
					$device_id = signature();
					
					$ip = getUserIP();
					$up = array();
					$up['ip_address'] = $ip;
					$up['os_info'] = $device['data']['os']['name']."".$device['data']['os']['version'];
					$up['device_id'] = $device_id;
					$up['platform'] = $device['data']['device'];
					$up['status'] = 1;
					
					$this->db->trans_begin();
					$this->db->where('id',$check['id'])->update('customer',$up);  
					$this->db->trans_commit(); 
					insert_log($check['id']);
					$this->session->set_userdata('get_user_login','aktif');
					$this->session->set_userdata('sospawn_customer',$check);
					redirect('home');
					return;
				}else
				{
					$ip = getUserIP();
					$check_ip = $this->db->where('ip_address',$ip)->where('type',0)->get('customer')->row_array();
					if(isset($check_ip['id']))
					{
						/*
						redirect('page-error/error_ip');
						return;	
						*/
					}
					/*$check_ip = $this->db->where('ip_address',$ip)->where('type',0)->get('customer')->row_array();
					if(isset($check_ip['id']))
					{
						redirect('page-error/error_ip');
						return;	
					}*/
					$get_device = $this->session->userdata('get_device');
					 
					$device_id = signature();
					if($get_device==$device_id)
					{
						/*
						redirect('page-error/error_ip');
						return;	
						*/
					}
					$time = time();
					$in = array();
					$in['email'] = $arr['email']; 
					$in['name'] = $arr['name'];
					$in['ip_address'] = $ip;
					$in['os_info'] = $device['data']['os']['name']."".$device['data']['os']['version'];
					$in['device_id'] = $device_id;
					$in['platform'] = $device['data']['device'];
					$in['created_on'] = $time;
					$in['updated_on'] = $time;
					$in['google_id'] = $arr['id'];
					$in['google_info'] = json_encode($arr);
					$in['type'] = 0;
					$in['status'] = 1;
					$in['passwords'] = $this->encryption->encrypt('google_oath');
					$this->db->trans_begin();
					$this->db->insert("customer",$in);
					$ids = $this->db->insert_id(); 
					$this->db->trans_commit();
					$data = $this->db->where('id',$ids)->get('customer')->row_array();
					$this->session->set_userdata('get_device',$device_id);
					$this->session->set_userdata('sospawn_customer',$data);
					redirect('home');
					return;
				}
			}
			
		}
		redirect("login");
		return;
	}
	 
	 
	 
	 
	 
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
	public function visit()
	{
		 $ips = getUserIP();
		 $this->db->trans_begin();
		 $in = array();
		 $in['ips'] = $ips;
		  $in['created_on'] = time();
		 $this->db->insert("visit",$in);
		 		if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
					return;
				}
				else
				{
					$this->db->trans_commit();
					 			
					json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
					return;
				}
	}
	public function register()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			unset($in['rememberme']);
			$check = $this->db->where('email',$in['email'])->get("visitor")->row_array();
			if(!isset($check['id']))
			{
				 $this->db->trans_begin();
				 $in['created_on'] = time(); 
				 $this->db->insert("visitor",$in);
						if ($this->db->trans_status() === FALSE)
						{
							$this->db->trans_rollback();
							json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
							return;
						}
						else
						{
							$this->db->trans_commit();
										
							json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
							return;
						}
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			 return;
			 
		}
		
	}
	public function login()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			unset($in['rememberme']);
			$check = $this->db->where('username',$in['username'])
			->where('password',$in['password'])
			->get("visitor")->row_array();
			if(isset($check['id']))
			{
				 json(array('error'=>false,'message'=>'Proccess Done','data'=>$check,'security'=>token()));
				 return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
			 
		}
		
	}
	 
	 
	 
}


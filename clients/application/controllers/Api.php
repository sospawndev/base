<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
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
	
	//forgot
	public function forgot()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$time = time();
			$check = $this->db->where('email',$in['email'])->get('customer');
			if($check->num_rows()==0)
			{
				json(array('error'=>true,'message'=>'Email Not Exist','security'=>token()));
				return;	
			}
			$c = $check->row_array();
			$in['urls'] = site_url("stats/forgot/".$c['activation_code']);
			$this->session->set_userdata('artskycust_forgot',$in);	
			 send_mail_forgot($in);
			json(array('error'=>false,'message'=>'Proses','security'=>token()));
			return;
		}
		show_404();
	}
	public function forgotsave()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$time = time();
			$check = $this->db->where('email',$in['email'])->get('customer');
			if($check->num_rows()==0)
			{
				json(array('error'=>true,'message'=>'Email Not Exist','security'=>token()));
				return;	
			}
			$this->db->where('id',$in['id'])->update("customer",array('passwords'=>$this->encryption->encrypt($in['password']))); 
			$this->session->set_userdata('artsky_login',$check->row_array());
			json(array('error'=>false,'message'=>'Proses','security'=>token()));
			return;
		}
		show_404();
	}
	public function resendforgot()
	{
		$in = $this->session->userdata('artskycust_forgot');
		send_mail_forgot($in);
	}
	public function syncs()
	{
		$in = array();
		$temps = $this->load->view('manager/syncs/main',$in,true); 
		json(array('error'=>false,'message'=>'Proses','security'=>token(),"temps"=>$temps));
		return;
	}
	public function check_syns()
	{
		$in = array();
		$temps = $this->load->view('manager/syncs/check',$in,true); 
		$links = $this->load->view('manager/syncs/links',$in,true); 
		//
		$opens = false;
		$vtiers = tiers();
								if(isset($vtiers['id']))
								{
									if($vtiers['ends']==0)
									{
										$percen = ($vtiers['phase_token']/$vtiers['total_supply'])*100;
										$starts = strtotime($vtiers['start_date']);
										$timenow = strtotime(date('Y-m-d H:i:s'));
										$ends = strtotime($vtiers['end_date']);
										if((round($percen,2)<100) && (($timenow>=$starts) && ($timenow<=$ends)))
										{ 
											$opens = true;
										}
									}
								}
		json(array('error'=>false,'message'=>'Proses','security'=>token(),"temps"=>$temps,"links"=>$links,"open"=>$opens,"data"=>$vtiers));
		return;
	} 
	public function get_by_province()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			return json(array('error'=>false,'data'=>$this->db->where('id_province',$id)->get('city')->result_array(),'message'=>'Proccess Done','security'=>token()));
		}
		show_404();
	}
	public function get_by_city()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			return json(array('error'=>false,'data'=>$this->db->where('id_city',$id)->get('district')->result_array(),'message'=>'Proccess Done','security'=>token()));
		}
		show_404();
	}
}
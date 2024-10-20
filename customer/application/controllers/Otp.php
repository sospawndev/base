<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Otp extends Wa_Controller {
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
	public function auth()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			 $this->load->library('smspintar');
			 $smspintar = $this->smspintar;
			 /*$auth = $smspintar->auth();
			 if(isset($auth['responseid']))
			 {
				 $token = $auth['responseid'];
				 
			 }*/
			 $telp = user_balance('telp');
			 $wa_code = get_unique_wa();
			 $this->session->set_userdata('wa_code',$wa_code);
			// $data = $smspintar->send('6289517704296',$wa_code);
			 $data = $smspintar->send($telp,$wa_code);
			 
			 if(isset($data['status']))
			 {
				if($data['status']=="000"  || $data['status']=="001"|| $data['status']=="002")
				{
					$this->session->set_userdata('smspintar_wa_code',$wa_code);
					json(array('error'=>false,'message'=>'Proccess','security'=>token()));
					return;
				}
			 }
		}
		json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
		return;
	}
	public function signed()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$wa_code = $this->session->userdata('smspintar_wa_code');
			$in = $this->input->post();
			if($in['wa_code']==$wa_code)
			{
				$id = user_balance('id');
				$this->db->trans_begin();
				$this->db->where('id',$id)->update('customer',array("wa_code"=>$wa_code,"phone_verification"=>1));
				$this->db->trans_commit();
				json(array('error'=>false,'message'=>'Proccess','security'=>token()));
				return;
			}
			
		}
		json(array('error'=>true,'message'=>'Invalid Code','security'=>token()));
		return;
	}
	#new
	public function newsign()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$wa_code = $this->session->userdata('smspintar_wa_code');
			$in = $this->input->post();
			if($in['wa_code']==$wa_code)
			{
				$id = user_balance('id');
				$this->db->trans_begin();
				$this->db->where('id',$id)->update('customer',array("wa_code"=>$wa_code,"phone_verification"=>1));
				$this->db->trans_commit();
				json(array('error'=>false,'message'=>'Proccess','security'=>token()));
				return;
			}
			
		}
		json(array('error'=>true,'message'=>'Invalid Code','security'=>token()));
		return;
	}
	public function newauth()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			 $n_resend =  $this->session->userdata('n_resend'); 
			 if($n_resend>3)
			 {
				 json(array('error'=>true,'message'=>'Too many try, contact administrator','security'=>token()));
				return;
			 }
			 
			 $this->load->library('smspintar');
			 $smspintar = $this->smspintar;
			 $in = $this->input->post(); 
			 /*$auth = $smspintar->auth();
			 if(isset($auth['responseid']))
			 {
				 $token = $auth['responseid'];
				 
			 }*/
			 $check_telp = $this->db
					 ->where("id<>".user_info('id')."") 
					 ->where('telp',$in['phones'])
					 ->get('v_customer');
					 
			if($check_telp->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Telp Sudah digunakan Akun Lain','security'=>token()));
				return;
			}
			 $telp = "62".$in['phones'];
			 $wa_code = get_unique_wa();
			 $this->session->set_userdata('wa_code',$wa_code);
			
			// $data = $smspintar->send('6289517704296',$wa_code);
			 $data = $smspintar->send($telp,$wa_code);
			 if(!empty($data))
			 {
				$data = json_decode($data,true);	
			 }
			  
			 if(isset($data['status']))
			 {
				if($data['status']=="000"  || $data['status']=="001"|| $data['status']=="002")
				{
					$this->db->trans_begin();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = time();
					$this->db->where('id',user_info('id'))->update('customer',array("telp"=>$in['phones']));
					$this->db->trans_commit();
					
					$this->session->set_userdata('smspintar_wa_code',$wa_code);
					$this->session->set_userdata('n_resend',(floatval($n_resend)+1));
					json(array('error'=>false,'message'=>'Proccess','security'=>token()));
					return;
				}
			 }
		}
		json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
		return;
	}
	public function resends()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			 $n_resend =  $this->session->userdata('n_resend'); 
			 if($n_resend>3)
			 {
				 json(array('error'=>true,'message'=>'Too many try, contact administrator','security'=>token()));
				return;
			 }
			 $this->load->library('smspintar');
			 $smspintar = $this->smspintar;
			 $in = $this->input->post(); 
			 /*$auth = $smspintar->auth();
			 if(isset($auth['responseid']))
			 {
				 $token = $auth['responseid'];
				 
			 }*/
			 $telp = "62".$in['phones'];
			 $wa_code =  $this->session->userdata('wa_code');
			 $data = $smspintar->send($telp,$wa_code);
			 if(!empty($data))
			 {
				$data = json_decode($data,true);	
			 }
			 if(isset($data['status']))
			 {
				if($data['status']=="000"  || $data['status']=="001"|| $data['status']=="002")
				{
				     $this->session->set_userdata('n_resend',(floatval($n_resend)+1));	
					json(array('error'=>false,'message'=>'Proccess','security'=>token()));
					return;
				}
			 }
		}
		json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
		return;
	}
	#== page verify
	public function verify()
	{
		$in = array(); 
		$n_resend =  $this->session->userdata('n_resend'); 
		if(empty($n_resend))
		$this->session->set_userdata('n_resend',1); 			
		$in['bread']['#'] = 'profile';
		 
		$in['title'] = ""; 
		$in['tpl'] = "otp/verify";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function verifys()
	{
		$in = array(); 
		$n_resend =  $this->session->userdata('n_resend'); 
		if(empty($n_resend))
		$this->session->set_userdata('n_resend',1); 			
		$in['bread']['#'] = 'profile';
		 
		$in['title'] = ""; 
		$in['tpl'] = "otp/verifys";
		$this->load->view('manager/layout',$in);
		return; 
	}
	 
	 
	 
}
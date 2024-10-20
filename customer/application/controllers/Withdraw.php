<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."libraries/CoinGeckoApi/vendor/autoload.php";
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class Withdraw extends Smart_Controller {

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
		  redirect("404");
		 return;
	} 
	public function index()
	{
		 
		
		$in = array(); 
		$currency = $this->db->where('displays',1)->where('wd',1)->get('currency')->row_array(); 			
		 
		$in['currency'] = $currency;  			
		$in['bread']['#'] = 'Withdraw';
		
		$in['title'] = "";
		$in['tpl'] = "withdraw/info";
		if(isset($currency['id']))
		{ 
			$in['tpl'] = "withdraw/form";
		}
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function akun_identity()
	{
		if($this->input->is_ajax_request() && $this->input->get())
		{
			$tgl = date('Y-m-d H:i');
			$value = $this->input->get("akun_identity");
			$value = preg_replace("/[^0-9.]/", "", $value);
			$rec = $this->db->where('id',$value)->get('v_customer');
			if($rec->num_rows()>0)
			{
				$arr = $rec->row_array();
				if($arr['id']!=user_info('id'))
				{
					json(array('error'=>false,'message'=>'Proccess',"arr"=>$arr,'security'=>token()));
					return;
				}
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
	} 
	public function validation_key()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$this->load->helper('string');
			$in = $this->input->post();
			$in['name'] = user_info('name');
			$in['email'] = user_info('email');
			
			$tgl = date('Y-m-d H:i');
			
			$rand = random_string('numeric',6);
			$in['acc_code'] = $rand;
			
			$this->session->set_userdata('aleo_customer_withdraw',$in);
			
			
			$this->send_mail_transfer($in);
			json(array('error'=>false,'message'=>'Proccess',"arr"=>$in,'security'=>token()));
			return;
			
		}
		json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
		return;
	} 
	public function resend_validation_key()
	{
		if($this->input->is_ajax_request() )
		{
			$in = $this->session->userdata('aleo_customer_withdraw');
			$this->send_mail_transfer($in);
			json(array('error'=>false,'message'=>'Proccess',"arr"=>$in,'security'=>token()));
			return;
		}
	}
	private function send_mail_transfer($in = array())
	{
		 
		$configs = email_config();
		 
		$in['base'] = base_url();
		$message = $this->load->view('manager/users/withdraw', $in, true);
		 
		//$CI->load->library('mailer');
		//$CI->mailer->sendEmail($in['email']),);
		
		$this->load->library('email');
		/*$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
		*/
		$this->email->initialize($configs);
		$this->email->from(config_item('email'), config_item('site_name'));
		$this->email->to($in['email']);
		$this->email->subject(config_item('site_name')."-".custom_language('Withdraw Verification'));
		$this->email->message($message);
		if($this->email->send())
		{
			return true;
		}
		return false;
		 
	}
	
	
	
	public function email_verifikasi()
	{
		if($this->input->is_ajax_request() && $this->input->get())
		{
			$email_verifikasi = $this->input->get("email_verifikasi");
			$in = $this->session->userdata('aleo_customer_withdraw');
			if(isset($in['acc_code']))
			{ 
				if($email_verifikasi==$in['acc_code'])
				{
					json(array('error'=>false,'message'=>'Proccess','security'=>token()));
					return;
				}
			}
			
		}
		json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
		return;
	} 
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$time = time();
			$transfer = $this->session->userdata('aleo_customer_withdraw');
			$in = $this->input->post();
			if(isset($transfer['acc_code']))
			{ 
				if($in['email_verifikasi']!=$transfer['acc_code'])
				{
					json(array('error'=>true,'message'=>custom_language('Email Verification').' Proccess Failed','security'=>token()));
					return;
				}
			}
			if($in['amount']>user_balance('balance'))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			$this->db->trans_begin();
			$time = time();
			$v = array();
			$v['tgl'] = date('Y-m-d h:i:s');
			$v['id_customer'] = user_info("id");
			$v['customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('customer')->row_array());
			$v['currency_info'] = json_encode($this->db->where('id',$in['id_currency'])->get('currency')->row_array());
			 
			$v['balance'] = user_balance('balance');
			$v['receive_address'] = $in['receive_address'];
			
			$v['total'] = $in['amount'];
			$admin_fee = floatval(setting("admin_fee"));
			$v['value_total'] = $v['total'];
			if($admin_fee>0)
			{
				/*
				$fee = $v['total'] * ($admin_fee/100);
				$v['admin_fee'] = $fee;	
				$v['value_total'] = $v['total']-$fee;	
				
				*/
				//$v['admin_fee'] = $admin_fee;	
				
				$fee = $v['total'] * ($admin_fee/100);
				$v['admin_fee'] = $fee;	
				
				$v['value_total'] = $v['total']-$fee;
			}
			 
			$v['created_on'] = $time;
			$v['created_by'] = user_info("id");
			 
			$this->db->insert('withdraw',$v);  
			
			$id = $this->db->insert_id(); 
			$v['id'] = $id;
			$this->send_mail_admin_notif($v);
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
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	}  
	private function send_mail_admin_notif($in = array())
	{
		 
		$configs = email_config();
		 
		$in['base'] = base_url();
		$in['message'] = "<p>There is is withdrawal with pid <b>W-".$in['id']."</b></p>";
		$in['message'] .= "<p>Customer Email : ".user_info('email')."</p>";
		
		$message = $this->load->view('manager/users/withdraw_notif_admin', $in, true);
		 
		//$CI->load->library('mailer');
		//$CI->mailer->sendEmail($in['email']),);
		
		$this->load->library('email');
		/*$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
		*/
		$this->email->initialize($configs);
		$this->email->from(config_item('email'), config_item('site_name'));
		$this->email->to(setting('email_notif'));
		$this->email->subject(config_item('site_name')."-".custom_language('Withdraw Notification'));
		$this->email->message($message);
		if($this->email->send())
		{
			return true;
		}
		return false;
		 
	}
}


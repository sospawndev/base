<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."libraries/CoinGeckoApi/vendor/autoload.php";
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class Withdraws extends Smart_Controller {

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
		 $withdraw_page = setting('withdraw_page');
		 if($withdraw_page!=1)
		 {
			 redirect("page-error/withdraw");
			 return;
		 }
		 $nama = user_balance('name');
		 $atas_nama = user_balance('atas_nama');
		 if(strtolower($nama)!=strtolower($atas_nama))
		 {
			 redirect("page-error/namas");
			 return;
		 }
		  
	} 
	public function index()
	{
		 
		
		$in = array(); 
		 			
		$in['bread']['#'] = 'Withdraws';
		
		$in['title'] = ""; 
		$in['tpl'] = "withdraws/form";
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
			//$rec = $this->db->where('id',$value)->get('v_customer');
			$rec = $this->db->where('pid',$value)->get('v_customer');
			if($rec->num_rows()>0)
			{
				$arr = $rec->row_array();
				if($arr['id']!=user_info('id'))
				{
					json(array('error'=>false,'message'=>'Proccess',"arr"=>$arr,'security'=>token()));
					return;
				}
			}
			json(array('error'=>true,'message'=>'Proccess Failed',"val"=>$value,'security'=>token()));
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
			
			$this->session->set_userdata('sospawn_customer_withdraw',$in);
			
			
			//$this->send_mail_transfer($in);
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
			$in = $this->session->userdata('sospawn_customer_withdraw');
			//$this->send_mail_transfer($in);
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
			$in = $this->session->userdata('sospawn_customer_withdraw');
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
	 
	public function save_tf()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			 
			
			#new
			$no_rekening =  user_balance('no_rekening');
			$atas_nama =  user_balance('atas_nama');
			if(empty($no_rekening))
			{
				json(array('error'=>true,'message'=>'no rekening empty','security'=>token()));
				return;
			}
			$check_rekening = $this->db
					 ->where("id<>".user_info('id')."") 
					 ->where('no_rekening',$no_rekening)
					 ->get('v_customer');
					 
			if($check_rekening->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Withdrawn Failed Rekening Sudah digunakan akun lain','security'=>token()));
				return;
			}
			$check_atas_nama = $this->db
					 ->where("id<>".user_info('id')."") 
					 ->where('atas_nama',$atas_nama)
					 ->get('v_customer');
					 
			if($check_atas_nama->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Withdrawn Failed Atas Nama Sudah digunakan akun lain','security'=>token()));
				return;
			}
			#new
			
			$checkwithdraws = $this->db->where('date(tgl)',date('Y-m-d'))->where('id_customer',user_info('id'))->get('withdraw');
			if($checkwithdraws->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'You have withdrawn today','security'=>token()));
				return;
			}
			$checkwithdraw = $this->db->where('status',3)->where('id_customer',user_info('id'))->get('withdraw');
			if($checkwithdraw->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Withdraw is Pending','security'=>token()));
				return;
			}
			$time = time();
			$transfer = $this->session->userdata('sospawn_customer_withdraw');
			$wd_additionalfee = floatval(setting("wd_additionalfee"));
			$in = $this->input->post();
			if(isset($transfer['acc_code']))
			{ 
				if($in['email_verifikasi']!=$transfer['acc_code'])
				{
					json(array('error'=>true,'message'=>custom_language('Email Verification').' Proccess Failed','security'=>token()));
					return;
				}
			}
			if(($wd_additionalfee+$in['amount'])>user_balance('balance'))
			{
				json(array('error'=>true,'message'=>'Balance not enough','security'=>token()));
				return;
			}
			  
			$this->load->library('linkque');
			$linkqu = $this->linkque->init();
			$trx = $linkqu->transfer();
			$waktu = time();
			$vals = $in;
			$vals['amount'] = $in['amount'];
			$vals['partner_ref'] = "wd-sospawn-".$waktu;
			$vals['customer_id'] = "sospawn-".user_info('id');
			$vals['customer_name'] = user_info('atas_nama');
			$vals['customer_telp'] = user_info('telp');
			$vals['customer_email'] = user_info('email');
			$vals['kodeBank'] = user_info('kodeBank'); 
			$vals['accountNumber'] = user_info('no_rekening'); 
			$vals['namaBank'] = user_info('namaBank'); 
			$bank_only = array("BANK BRI","BANK BCA","BANK MANDIRI","BANK BNI","BANK CIMB NIAGA");
			$stats_bank = false;
			$name = ""; 
			for($i=0;$i<count($bank_only);$i++)
			{
				
				if($bank_only[$i]==$vals['namaBank'])
				{
					$stats_bank = true;
				}
			}
			if(!$stats_bank)
			{
				json(array('error'=>true,'message'=>'Bank Only '.implode(",",$bank_only),'security'=>token()));
				return;	
			}
			set_va_value($vals);
			$arr = $trx->inquiry(function($trx) {
						 
						 $vals = get_va_value();
					     //$trx->setAmount($vals['amount'])
						 $trx->setAmount(1000)
					         ->setExpired(300)
					         ->setCustomerId($vals['customer_id'])
					         ->setPartnerRef($vals['partner_ref'])
					         ->setCustomerName($vals['customer_name'])
					         ->setCustomerPhone($vals['customer_telp'])
					         ->setCustomerEmail($vals['customer_email'])
							 ->setBankCode($vals['kodeBank'])
							 ->setaccountNumber($vals['accountNumber'])
							 ; 
					 });
			 		 
			if(!isset($arr->status))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			if(!isset($arr->inquiry_reff))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			if($arr->status!="SUCCESS")
			{
				json(array('error'=>true,'message'=>$arr->response_desc,'security'=>token()));
				return;
			}
			
			$accountname = $arr->accountname;
			if($atas_nama != $accountname)
			{
				json(array('error'=>true,'message'=>'Atas Nama Anda Salah, Atas Nama Tertera di Akun Bank Langsung '.$accountname,'security'=>token()));
				return;
			}
			$check_atas_nama = $this->db
					 ->where("id<>".user_info('id')."") 
					 ->where('atas_nama',$accountname)
					 ->get('v_customer');
					 
			if($check_atas_nama->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Withdrawn Failed Atas Nama Sudah digunakan akun lain','security'=>token()));
				return;
			}
			
			/*$inquiry = set_inquiry_value($arr);
			$inq = get_inquiry_value();
			if(!isset($inq->inquiry_reff))
			{
				json(array('error'=>true,'message'=>'Respond Proccess Failed','security'=>token()));
				return;
			}
			$li = $trx->send(function($trx) {
						 
						 $vals = get_va_value();
						 $inq = get_inquiry_value();
					     $trx->setAmount($vals['amount'])
					         ->setExpired(300)
					         ->setCustomerId($vals['customer_id'])
					         ->setPartnerRef($vals['partner_ref'])
					         ->setCustomerName($vals['customer_name'])
					         ->setCustomerPhone($vals['customer_telp'])
					         ->setCustomerEmail($vals['customer_email'])
							 ->setBankCode($vals['kodeBank'])
							 ->setaccountNumber($vals['accountNumber'])
							 ->setInquiryRef($inq->inquiry_reff); 
					 });
			if(!isset($li->status))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			if(!isset($li->inquiry_reff))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			*/
			/*if($li->status!="SUCCESS")
			{
				json(array('error'=>true,'message'=>$arr->response_desc,'security'=>token()));
				return;
			}*/
			
			 	 
			$this->db->trans_begin();
			$time = time();
			
			//$in['amount'] += $wd_additionalfee;
			$v = array();
			 
			//payments
			//$v['status'] = 2;
			$v['status'] = 0;
			/*
			if($li->status=="SUCCESS")
			{
				$v['status'] = 1;
			}
			if($li->status=="PENDING")
			{
				$v['status'] = 1;
			}*/
			
			#== check wd
			/*
			$v['wd_info'] = json_encode($li);
			$v['respond_txt'] = $li->response_desc;
			$v['statuses'] = $li->status;
			$v['wd_additionalfee'] = $wd_additionalfee;
			*/
			#== check wd
			$v['tgl'] = date('Y-m-d H:i:s');
			$v['id_customer'] = user_info("id");
			$v['customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('customer')->row_array());
			//$v['currency_info'] = json_encode($this->db->where('id',$in['id_currency'])->get('currency')->row_array());
			 
			$v['balance'] = user_balance('balance');
			$v['atas_nama'] = user_balance('atas_nama');
			$v['no_rekening'] = user_balance('no_rekening');
			$v['kodeBank'] = user_balance('kodeBank');
			$v['namaBank'] = user_balance('namaBank'); 
			
			$v['total'] = $in['amount'];
			$admin_fee = floatval(setting("admin_fee"));
			$v['value_total'] = $v['total'];
			$v['value_total'] += $wd_additionalfee;
			$v['partner_reff'] = $vals['partner_ref'];
			/*if($admin_fee>0)
			{
				 
				
				$fee = $v['total'] * ($admin_fee/100);
				$v['admin_fee'] = $fee;	
				
				$v['value_total'] = $v['total']-$fee;
			}*/
			 
			 
			 
			$v['created_on'] = $time;
			$v['created_by'] = user_info("id");
			
			$this->db->insert('withdraw',$v);  
			
			
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
	public function save_tf_()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			 
			
			#new
			$no_rekening =  user_balance('no_rekening');
			$atas_nama =  user_balance('atas_nama');
			if(empty($no_rekening))
			{
				json(array('error'=>true,'message'=>'no rekening empty','security'=>token()));
				return;
			}
			$check_rekening = $this->db
					 ->where("id<>".user_info('id')."") 
					 ->where('no_rekening',$no_rekening)
					 ->get('v_customer');
					 
			if($check_rekening->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Withdrawn Failed Rekening Sudah digunakan akun lain','security'=>token()));
				return;
			}
			$check_atas_nama = $this->db
					 ->where("id<>".user_info('id')."") 
					 ->where('atas_nama',$atas_nama)
					 ->get('v_customer');
					 
			if($check_atas_nama->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Withdrawn Failed Atas Nama Sudah digunakan akun lain','security'=>token()));
				return;
			}
			#new
			
			$checkwithdraws = $this->db->where('date(tgl)',date('Y-m-d'))->where('id_customer',user_info('id'))->get('withdraw');
			if($checkwithdraws->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'You have withdrawn today','security'=>token()));
				return;
			}
			$checkwithdraw = $this->db->where('status',3)->where('id_customer',user_info('id'))->get('withdraw');
			if($checkwithdraw->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Withdraw is Pending','security'=>token()));
				return;
			}
			$time = time();
			$transfer = $this->session->userdata('sospawn_customer_withdraw');
			$wd_additionalfee = floatval(setting("wd_additionalfee"));
			$in = $this->input->post();
			if(isset($transfer['acc_code']))
			{ 
				if($in['email_verifikasi']!=$transfer['acc_code'])
				{
					json(array('error'=>true,'message'=>custom_language('Email Verification').' Proccess Failed','security'=>token()));
					return;
				}
			}
			if(($wd_additionalfee+$in['amount'])>user_balance('balance'))
			{
				json(array('error'=>true,'message'=>'Balance not enough','security'=>token()));
				return;
			}
			  
			$this->load->library('linkque');
			$linkqu = $this->linkque->init();
			$trx = $linkqu->transfer();
			$waktu = time();
			$vals = $in;
			$vals['amount'] = $in['amount'];
			$vals['partner_ref'] = "wd-sospawn-".$waktu;
			$vals['customer_id'] = "sospawn-".user_info('id');
			$vals['customer_name'] = user_info('atas_nama');
			$vals['customer_telp'] = user_info('telp');
			$vals['customer_email'] = user_info('email');
			$vals['kodeBank'] = user_info('kodeBank'); 
			$vals['accountNumber'] = user_info('no_rekening'); 
			$vals['namaBank'] = user_info('namaBank'); 
			$bank_only = array("BANK BRI","BANK BCA","BANK MANDIRI","BANK BNI","BANK CIMB NIAGA");
			$stats_bank = false;
			$name = ""; 
			for($i=0;$i<count($bank_only);$i++)
			{
				
				if($bank_only[$i]==$vals['namaBank'])
				{
					$stats_bank = true;
				}
			}
			if(!$stats_bank)
			{
				json(array('error'=>true,'message'=>'Bank Only '.implode(",",$bank_only),'security'=>token()));
				return;	
			}
			set_va_value($vals);
			$arr = $trx->inquiry(function($trx) {
						 
						 $vals = get_va_value();
					     //$trx->setAmount($vals['amount'])
						 $trx->setAmount(1000)
					         ->setExpired(300)
					         ->setCustomerId($vals['customer_id'])
					         ->setPartnerRef($vals['partner_ref'])
					         ->setCustomerName($vals['customer_name'])
					         ->setCustomerPhone($vals['customer_telp'])
					         ->setCustomerEmail($vals['customer_email'])
							 ->setBankCode($vals['kodeBank'])
							 ->setaccountNumber($vals['accountNumber'])
							 ; 
					 });
			 		 
			if(!isset($arr->status))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			if(!isset($arr->inquiry_reff))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			if($arr->status!="SUCCESS")
			{
				json(array('error'=>true,'message'=>$arr->response_desc,'security'=>token()));
				return;
			}
			
			$accountname = $arr->accountname;
			if($atas_nama != $accountname)
			{
				json(array('error'=>true,'message'=>'Atas Nama Anda Salah','security'=>token()));
				return;
			}
			$check_atas_nama = $this->db
					 ->where("id<>".user_info('id')."") 
					 ->where('atas_nama',$accountname)
					 ->get('v_customer');
					 
			if($check_atas_nama->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Withdrawn Failed Atas Nama Sudah digunakan akun lain','security'=>token()));
				return;
			}
			
			$inquiry = set_inquiry_value($arr);
			$inq = get_inquiry_value();
			if(!isset($inq->inquiry_reff))
			{
				json(array('error'=>true,'message'=>'Respond Proccess Failed','security'=>token()));
				return;
			}
			$li = $trx->send(function($trx) {
						 
						 $vals = get_va_value();
						 $inq = get_inquiry_value();
					     $trx->setAmount($vals['amount'])
					         ->setExpired(300)
					         ->setCustomerId($vals['customer_id'])
					         ->setPartnerRef($vals['partner_ref'])
					         ->setCustomerName($vals['customer_name'])
					         ->setCustomerPhone($vals['customer_telp'])
					         ->setCustomerEmail($vals['customer_email'])
							 ->setBankCode($vals['kodeBank'])
							 ->setaccountNumber($vals['accountNumber'])
							 ->setInquiryRef($inq->inquiry_reff); 
					 });
			if(!isset($li->status))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			if(!isset($li->inquiry_reff))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			/*if($li->status!="SUCCESS")
			{
				json(array('error'=>true,'message'=>$arr->response_desc,'security'=>token()));
				return;
			}*/
			
			 	 
			$this->db->trans_begin();
			$time = time();
			
			//$in['amount'] += $wd_additionalfee;
			$v = array();
			 
			//payments
			$v['status'] = 2;
			if($li->status=="SUCCESS")
			{
				$v['status'] = 1;
			}
			if($li->status=="PENDING")
			{
				$v['status'] = 1;
			}
			
			#== check wd
			$v['wd_info'] = json_encode($li);
			$v['respond_txt'] = $li->response_desc;
			$v['statuses'] = $li->status;
			$v['wd_additionalfee'] = $wd_additionalfee;
			#== check wd
			$v['tgl'] = date('Y-m-d H:i:s');
			$v['id_customer'] = user_info("id");
			$v['customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('customer')->row_array());
			//$v['currency_info'] = json_encode($this->db->where('id',$in['id_currency'])->get('currency')->row_array());
			 
			$v['balance'] = user_balance('balance');
			$v['atas_nama'] = user_balance('atas_nama');
			$v['no_rekening'] = user_balance('no_rekening');
			$v['kodeBank'] = user_balance('kodeBank');
			$v['namaBank'] = user_balance('namaBank'); 
			
			$v['total'] = $in['amount'];
			$admin_fee = floatval(setting("admin_fee"));
			$v['value_total'] = $v['total'];
			$v['value_total'] += $wd_additionalfee;
			$v['partner_reff'] = $vals['partner_ref'];
			/*if($admin_fee>0)
			{
				 
				
				$fee = $v['total'] * ($admin_fee/100);
				$v['admin_fee'] = $fee;	
				
				$v['value_total'] = $v['total']-$fee;
			}*/
			 
			 
			 
			$v['created_on'] = $time;
			$v['created_by'] = user_info("id");
			
			$this->db->insert('withdraw',$v);  
			
			
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
	public function checkbank()
	{
		$this->load->library('linkque');
		$linkqu = $this->linkque->init();
		$admin = $linkqu->administration();
		json($admin->banks());
		return;	
			
	}
}


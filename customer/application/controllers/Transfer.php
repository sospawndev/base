<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."libraries/CoinGeckoApi/vendor/autoload.php";
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class Transfer extends Smart_Controller {

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
		 redirect("page-error/transfer");
		 return; 
	} 
	public function index()
	{
		 
		
		$in = array(); 
		 			
		$in['bread']['#'] = 'Transfer';
		
		$in['title'] = ""; 
		$in['tpl'] = "transfer/form";
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
			
			$this->session->set_userdata('aleo_customer_transfer',$in);
			
			
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
			$in = $this->session->userdata('aleo_customer_transfer');
			$this->send_mail_transfer($in);
			json(array('error'=>false,'message'=>'Proccess',"arr"=>$in,'security'=>token()));
			return;
		}
	}
	private function send_mail_transfer($in = array())
	{
		 
		$configs = email_config();
		 
		$in['base'] = base_url();
		$message = $this->load->view('manager/users/transfer', $in, true);
		 
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
		$this->email->subject(config_item('site_name')."-".custom_language('Transfer Verification'));
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
			$in = $this->session->userdata('aleo_customer_transfer');
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
			$transfer = $this->session->userdata('aleo_customer_transfer');
			$in = $this->input->post();
			if(isset($transfer['acc_code']))
			{ 
				if($in['email_verifikasi']!=$transfer['acc_code'])
				{
					json(array('error'=>true,'message'=>custom_language('Email Verification').' Proccess Failed','security'=>token()));
					return;
				}
			}
			if(!isset($in['akun_identity']))
			{
				json(array('error'=>true,'message'=>custom_language('Akun Identity').' Proccess Failed','security'=>token()));
				return;
			}
			$to = preg_replace("/[^0-9.]/", "", $in['akun_identity']);
			if($to<start_ref_num())
			{
				json(array('error'=>true,'message'=>custom_language('Akun Identity').' Proccess Failed','security'=>token()));
				return;
			}
			
			$this->db->trans_begin();
			$time = time();
			$v = array();
			$v['tgl'] = date('Y-m-d h:i:s');
			$v['from_customer'] = user_info("id");
			$v['from_customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('v_customer')->row_array());
			
			$to_customer = $this->db->where('pid',$to)->get('v_customer')->row_array();
			$v['to_customer'] = isset($to_customer['id'])?$to_customer['id']:"";
			$v['to_customer_info'] = json_encode($to_customer);
			$v['status'] = 1;
			//$v['total'] = $in['amount'];
			$admin_fee = floatval(setting("admin_fee_tf"));
			$v['full_total'] = $in['amount'];
			$v['total'] = $v['full_total'];
			if($admin_fee>0)
			{
				$v['admin_fee'] = $admin_fee;	
				$v['total'] = $v['full_total']-$admin_fee;
			}
			 
			 
			$v['created_on'] = $time;
			$v['created_by'] = user_info("id");
			
			$this->db->insert('transfer',$v);  
			
			
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
	
}


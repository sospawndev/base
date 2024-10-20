<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."libraries/CoinGeckoApi/vendor/autoload.php";
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class Payment extends Smart_Controller {

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
	public function index()
	{
		 
		
		$in = array(); 
		 			
		$in['bread']['#'] = 'payment';
		
		$in['title'] = ""; 
		$in['tpl'] = "payment/main";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function topup()
	{
		 
		$client = new CoinGeckoClient();
		$in = array(); 
		$currency = $this->db->where('displays',1)->get('currency')->result_array(); 			
		for($i=0;$i<count($currency);$i++)
		{
			$currency[$i]['price'] = 1;
			if(!empty($currency[$i]['simbol']))
			{
				$c = array();
				try {
				  $c = $client->simple()->getPrice($currency[$i]['simbol'], 'usd');
				}
				
				 
				catch(Exception $e) {
				   
				}
				 
				 
				
				$currency[$i]['data'] = $c;
				$currency[$i]['price'] = isset($c[$currency[$i]['simbol']]['usd'])?$c[$currency[$i]['simbol']]['usd']:"";
				 
			}
		}
		$in['currency'] = $currency; 
		$in['bread']['#'] = 'payment';
		
		$in['title'] = ""; 
		$in['tpl'] = "payment/topup";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function savetopup()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$time = time();
			
			$in = $this->input->post();
			$ch_tp = $this->db->where('id_customer',user_info("id"))->where('status',0)->get('topup');
			if($ch_tp->num_rows()>0)
			{
				json(array('error'=>true,'message'=>custom_language('You have pending Topup'),'security'=>token()));
				return;
			}
			if(!empty($in['id_promo']))
			{  
				$ch = $this->db->where('id',$in["id_promo"])->get('promo');
				if($ch->num_rows()>0)
				{
					$in['promo_info'] = json_encode($this->db->where('id',$in['id_promo'])->get('promo')->row_array());
					
				}
				else
				{
					json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
					return;
				}
			}
			$currency = $this->db->where('id',$in["id_currency"])->get('currency')->row_array();
			$this->db->trans_begin();
			$time = time();
			$in['tanggal'] = date('Y-m-d');
			$in['id_customer'] = user_info("id");
			$in['customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('customer')->row_array());
			
			$in['currency_info'] = json_encode($currency);
			 
			$in['created_on'] = $time;
			$in['created_by'] = user_info("id");
			
			 
			$in['pid'] = get_unique_topup(); 
			$this->db->insert('topup',$in);  
			$this->send_mail_admin_notif($in);
			
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
	public function promorcode()
	{
		if($this->input->is_ajax_request() && $this->input->get())
		{
			$tgl = date('Y-m-d H:i');
			$value = $this->input->get("value_total");
			$sql = "select m_promo.*,(select sum(id) as total_promo from m_topup where m_topup.id_promo=m_promo.id limit 1) as total_promo from m_promo where pid='".$this->input->get("promo_code")."' and (m_promo.start_date<='".$tgl ."' and m_promo.end_date >='".$tgl."')";
			 
			$ch = $this->db->query($sql);//$this->db->where('pid',$this->input->post("promo_code"))->get('promo');
			if($ch->num_rows()>0)
			{
				$arr = $ch->row_array();
				if($arr['total_promo']<$arr['total_used'])
				{ 
					$usdt = $arr['jumlah'];
					$message = "$".$usdt;
					if($arr['type']==1)
					{
						$usdt = ($value/100) * $arr['jumlah'];
						$message = $arr['jumlah']."% with value $".$usdt;
					}
					json(array('error'=>false,'message'=>$message,"data"=>$usdt,"arr"=>$arr,'security'=>token()));
					return;
				}
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
	}
	
	private function send_mail_admin_notif($in = array())
	{
		 
		$configs = email_config();
		 
		$in['base'] = base_url();
		$in['message'] = "<p>There is is Top up with pid <b>".$in['pid']."</b></p>";
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
		$this->email->to(setting('email_topup'));
		$this->email->subject(config_item('site_name')."-".custom_language('Topup Notification'));
		$this->email->message($message);
		if($this->email->send())
		{
			return true;
		}
		return false;
		 
	}
	
}


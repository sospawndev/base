<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."libraries/CoinGeckoApi/vendor/autoload.php";
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
class Buy extends Smart_Controller {

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
		//echo strlen('44e25bc0ed840f9bf0e58d6227db15192d5b89e79ba4304da16b09703f68ceaf');
		//exit;
		 
		/*$client = new CoinGeckoClient();
		//$data = $client->coins()->getList(); //$client->simple()->getPrice('0x,binance', 'usd,rub');
		$data = $client->simple()->getPrice('binancecoin', 'usd,rub');
		print_r($data);
		exit;
		*/
		 
		$client = new CoinGeckoClient();
		$currency = $this->db->where('displays',1)->get('currency')->result_array();
		$out = array();
		for($i=0;$i<count($currency);$i++)
		{
			$currency[$i]['price'] = 1;
			if(!empty($currency[$i]['simbol']))
			{
				$c = array();
				try {
				  $c = $client->simple()->getPrice($currency[$i]['simbol'], 'usd');
				}
				
				//catch exception
				catch(Exception $e) {
				   
				}
				//binanceidr
				if($currency[$i]['simbol']=="binanceidr")
				{
					if(!isset($c[$currency[$i]['simbol']]['usd']))
					{
						$c[$currency[$i]['simbol']]['usd'] = "0.0000625";
					}
					 
				}
				
				$currency[$i]['data'] = $c;
				$currency[$i]['price'] = isset($c[$currency[$i]['simbol']]['usd'])?$c[$currency[$i]['simbol']]['usd']:"";
				//$c = $client->simple()->getPrice($currency[$i]['simbol'], 'usd');
				
				//$currency[$i]['price'] = isset($c[$currency[$i]['simbol']]['usd'])?rtrim(number_format($c[$currency[$i]['simbol']]['usd'], 15), 0) :"";
			}
		}
		
		$coin = $currency;
		 
		$in = array();
		$in['coin'] = array(); 
		$in['currency'] = $currency; 
		 
		$in['tier'] = $this->db->where('displays',1)->get('tier')->row_array();	
		if(isset($in['tier']['id']))
		{
			$orders =  $this->db->select("sum(total) as total")
									->where('status',1)
									->where('id_tier',$in['tier']['id'])
									->get('order_presale')->row_array();
									
			$in['tier']['order'] = $orders['total'];
		}
		$in['bank_transfer'] = $this->db
								->select("m_bank_transfer.*,m_bank.name as bank")
								->join("m_bank","m_bank.id=m_bank_transfer.id_bank","inner")
								->where('m_bank_transfer.displays',1)->get('bank_transfer')->result_array();	
		
		$in['bread']['#'] = 'Buy';
		
		$in['title'] = ""; 
		$in['tpl'] = "buy/main";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$tier = $this->db->where('id',$in["id_tier"])->get('tier')->row_array();	
			if(!isset($tier['id']))
			{
				json(array('error'=>true,'message'=>'Presale Close','security'=>token()));
				return;
			}
			
			 if(isset($_FILES['image']))
			 {
					if($_FILES['image']['error']==0)
					{
						$name = get_unique_file($_FILES['image']['name']);
						if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['image']['tmp_name'],config_item('upload_path').$name))
						{
							$in['bukti'] = $name;
						}
					}
			 }else
			 {
				if(empty(user_info("wallet_address")))
				{
					json(array('error'=>true,'message'=>'wallet address Empty, Process Failed','security'=>token()));
					return;
				}	 
			 }
			 
			// 
			$orders =  $this->db->select("sum(total) as total")
									->where('status',1)
									->where('id_tier',$in['id_tier'])
									->get('order_presale')->row_array();
			if($orders['total']>=$tier['total_supply'])
			{
				json(array('error'=>true,'message'=>'Presale Closed ','security'=>token()));
				return;
			}
			//						
			/*
			if($orders['total']>=$tier['total_supply'])
			{
				 $this->db->where('id',$in["id_tier"])->update('tier',array('displays'=>0)); 
			}
			*/ 
			
			$currency = $this->db->where('id',$in["id_currency"])->get('currency')->row_array();
			$this->db->trans_begin();
			$time = time();
			$in['tanggal'] = date('Y-m-d');
			$in['id_customer'] = user_info("id");
			$in['customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('customer')->row_array());
			$in['currency_info'] = json_encode($currency);
			$in['network'] = $currency['network'];
			if(isset($in['id_bank_transfer']))
			{
				$in['bank_transfer'] = json_encode($this->db->where('id',$in["id_bank_transfer"])->get('bank_transfer')->row_array());	
			}
			$in['tier_info'] = json_encode($this->db->where('id',$in["id_tier"])->get('tier')->row_array());
			$in['address_customer'] = user_info("wallet_address");
			$in['pid'] = get_unique_order_presale(); 
			$this->db->insert('order_presale',$in);  
			
			
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
	
	public function test()
	{
		//$data = $client->coins()->getCoin('meong-token');
		//print_r($data);
		//exit;	
	}
	
}


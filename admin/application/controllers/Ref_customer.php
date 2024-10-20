<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ref_customer extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		 
		$in['use_hedaer'] = true;
		$in['title'] = 'Master Ref Customer';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/tier')] = 'City';
		$in['tpl'] = 'refferal/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		 if($this->input->is_ajax_request())
		 {
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_v_customer.id';
			$columns    = array(
			array('db'=>'m_v_customer.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return $d;
			}),
			
			
			
			array('db'=>"(select concat(h.name,'<br/>',h.email) as fulls from m_v_customer h where h.id=m_v_customer.refferal)",'dt'=>1,'alias'=>'diref','formatter'=>function($d,$row){
				return $d;
			}),
			array('db'=>'m_v_customer.name','dt'=>2,'alias'=>'fulls','formatter'=>function($d,$row){
				 $out = "";
				  
				 if(!empty($row->email))
				 {
					 $out .= $d."<br/>";
					 $out .= $row->email."<br/>";
					 
					 
				 }
				 return  $out;
			}),
			array('db'=>'(select sum(usdt) as total from m_v_order_ref h where h.id_users_order=m_v_customer.id)','dt'=>3,'alias'=>'usdt','formatter'=>function($d,$row){
				 return $d;
			}),
			
			array('db'=>'(select sum(bonus_token) as total from m_v_order_ref h where h.id_users_order=m_v_customer.id)','dt'=>4,'alias'=>'xome','formatter'=>function($d,$row){
				 return number_format($d,2);
			}), 
			array('db'=>'(select sum(usdt_token) as total from m_v_order_ref h where h.id_users_order=m_v_customer.id)','dt'=>5,'alias'=>'r_usdt','formatter'=>function($d,$row){
				 return number_format($d,2);
			}), 
			array('db'=>'(select sum(token_user_order) as total from m_v_order_ref h where h.id_users_order=m_v_customer.id)','dt'=>6,'alias'=>'token_user_order','formatter'=>function($d,$row){
				 return number_format($d,2);
			}),
			array('db'=>'(select sum(bonus_user_order) as total from m_v_order_ref h where h.id_users_order=m_v_customer.id)','dt'=>7,'alias'=>'bonus_user_order','formatter'=>function($d,$row){
				 return number_format($d,2);
			}),  
			array('db'=>'(select sum(total_user_order) as total from m_v_order_ref h where h.id_users_order=m_v_customer.id)','dt'=>8,'alias'=>'total_user_order','formatter'=>function($d,$row){
				$yy = floatval($row->token_user_order) + floatval($row->bonus_user_order);
				 return number_format($yy,2);
			}),
			array('db'=>'m_v_customer.email','dt'=>9,'alias'=>'email','formatter'=>function($d,$row){
				 return $d;
			}),
			);
			$table = 'm_v_customer ';
			$whereResult = NULL;
			$whereAll = 'm_v_customer.refferal>0 and (select sum(usdt) as total from m_v_order_ref h where h.id_users_order=m_v_customer.id)>0';
			
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		 }
		//show_404();
	}
	 
	 
	 
}
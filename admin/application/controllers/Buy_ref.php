<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy_ref extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		
		$in['use_hedaer'] = true;
		
		$in['title'] = ' Reward Refferal';
		$in['desc'] = 'you can manage your Topup here';
		$in['bread']['#'] = 'Reward Refferal';
		$in['bread'][site_url('manager/package')] = 'Topup';
		$in['tpl'] = 'buy_ref/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_buy_ref.id';
			$columns    = array(
			 
			array('db'=>"b.email",'dt'=>0,'alias'=>'froms','formatter'=>function($d,$row){
				$chtml = $d;
				/*$mylevels = my_level($row->to_customer); 
				$mylevel_earn = user_level($mylevels);
				if(isset($mylevel_earn['id']))
				{
					$chtml .="<br/>".$mylevel_earn['level']."";	
					$chtml .="<br/>".$mylevel_earn['refferal_reward']."%";	
				}*/
				return $chtml;
			}), 
			array('db'=>"(select name from m_v_customer y where y.id=b.id limit 1)",'dt'=>1,'alias'=>'name_froms','formatter'=>function($d,$row){
				return $d;
			}), 
			array('db'=>"m_buy.pid",'dt'=>2,'alias'=>'pid'),
			array('db'=>"concat('A-',(select pid from m_v_customer y where y.id=m_buy_ref.id_customer limit 1))",'dt'=>3,'alias'=>'Cpid','formatter'=>function($d,$row){
				return $d;
			}), 
			
			 
			array('db'=>"m_buy.tanggal",'dt'=>4,'alias'=>'tanggal','formatter'=>function($d,$row){
				 return date('Y-m-d',strtotime($d));
			}),
			/*
			array('db'=>"m_buy_ref.level_earn_info",'dt'=>3,'alias'=>'level_earn_info','formatter'=>function($d,$row){
				if(!empty($d))
				{
					$lev = json_decode($d,true);
					if(isset($lev['id']))
					{
						$cc = $lev['level'];
						$cc .= "<br/> Reward :".number_format($lev['refferal_reward'],0)."%";
						return $cc;	
					}
				}
				 return "";
			}),
			*/ 
			array('db'=>"m_buy.total",'dt'=>5,'alias'=>'value_total','formatter'=>function($d,$row){
				return "$".number_format($d,2) ;
			}), 
			array('db'=>"m_buy_ref.ref_reward",'dt'=>6,'alias'=>'ref_reward','formatter'=>function($d,$row){
				return number_format($d,4)."%" ;
			}), 
			array('db'=>"m_buy_ref.total",'dt'=>7,'alias'=>'ref_total','formatter'=>function($d,$row){
				return "$".number_format($d,2) ;
			}), 
			array('db'=>"(select email from m_v_customer y where y.id=m_buy_ref.id_customer limit 1)",'dt'=>8,'alias'=>'cust','formatter'=>function($d,$row){
				$chtml = $d ;
				/*$mylevels = my_level($row->id_customer); 
				$mylevel_earn = user_level($mylevels);
				if(isset($mylevel_earn['id']))
				{
					$chtml .="<br/>".$mylevel_earn['level']."";	
					$chtml .="<br/>".$mylevel_earn['refferal_reward']."%";	
				}*/
				return $chtml;
			}), 
			array('db'=>"m_buy_ref.id_customer",'dt'=>9,'alias'=>'id_customer','formatter'=>function($d,$row){
				return $d;
			}), 
			array('db'=>"m_buy_ref.to_customer",'dt'=>10,'alias'=>'to_customer','formatter'=>function($d,$row){
				return $d;
			}),   
			);
			$table = 'm_buy_ref inner join m_buy on(m_buy_ref.id_buy = m_buy.id)  inner join m_v_customer b on (b.id = m_buy_ref.to_customer)';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	 
}
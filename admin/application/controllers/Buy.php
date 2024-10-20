<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		
		$in['use_hedaer'] = true;
		
		$in['title'] = ' Buy';
		$in['desc'] = 'you can manage your Buy here';
		$in['bread']['#'] = 'Buy';
		$in['bread'][site_url('manager/package')] = 'Buy';
		$in['tpl'] = 'buy/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_buy.id';
			$columns    = array(
			 
			array('db'=>"m_buy.pid",'dt'=>0,'alias'=>'pid'),
			array('db'=>'m_v_customer.pid','dt'=>1,'alias'=>'akun_identity','formatter'=>function($d,$row){
				return "A-".$d;
			}),
			array('db'=>"CONCAT(m_v_customer.name,'<br/>(',m_v_customer.email,')')",'dt'=>2,'alias'=>'custs'),
			 
			array('db'=>"m_buy.tanggal",'dt'=>3,'alias'=>'tanggal','formatter'=>function($d,$row){
				 return $d;
			}),
			 
			array('db'=>"m_buy.promo_code",'dt'=>4,'alias'=>'promo_code','formatter'=>function($d,$row){
				return $d;
			}), 
			array('db'=>"m_buy.value_total",'dt'=>5,'alias'=>'value_total','formatter'=>function($d,$row){
				return number_format($d,2) ;
			}), 
			array('db'=>"m_buy.total",'dt'=>6,'alias'=>'total','formatter'=>function($d,$row){
				$cx = number_format($d,2);
				$fd = $cx;
				if($row->promo_value>0)
				{
					$fd = $cx; 
					$fd .= "<br/><small><b>Used Promo With value ".number_format($row->promo_value,2)." </b><small>";
					
				}
				return $fd ;
			}), 
			array('db'=>"m_buy.status",'dt'=>7,'alias'=>'status','formatter'=>function($d,$row){
				  
				 $bg = array("orange","green","red");
				 $bg_color = isset($bg[$d])?"background:".$bg[$d]."; color:white;":"";
				 if($d==1)
				 {
					 return "<span class='btn' style='".$bg_color."'>".payments($d)."</span>";
				 }
				 return "<button class='btn btn-sm btn-status' style='".$bg_color."' data-ref='".$row->ids."'>".payments($d)."</button>";
			}), 
			 array('db'=>'m_buy.id','dt'=>8,'alias'=>'id','formatter'=>function($d,$row){
				//if($row->status!=1)
				//{
					return ' 
								 
								<button class="btn btn-xs btn-sm btn-danger btn-delete-users" type="button" data-toggle="tooltip" title="" data-original-title="Remove" data-ref="'.$row->ids.'"><i class="fa fa-times"></i></button>
							</span>	
							 ';
				//} 
			 }),
			 array('db'=>"m_buy.id",'dt'=>9,'alias'=>'ids'),
			 array('db'=>"m_buy.promo_value",'dt'=>10,'alias'=>'promo_value'),
			);
			$table = 'm_buy inner join m_v_customer on (m_v_customer.id = m_buy.id_customer)';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			if(isset($_GET['status']))
			{
				if($_GET['status']!=-1)
				{
					$whereAll = "m_buy.status='".$_GET['status']."'";
				}
			} 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function status()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$check = $this->db->where('id',$in['id'])->get('buy')->row_array();
			if(!isset($check['id']))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			//
			//$price_coin = settings("price_coin"); 
			
			//
			
			$customer =  $this->db->where('id',$check['id_customer'])->get('customer')->row_array();
			if(!isset($customer['id']))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			$ref =  $this->db->where('id',$customer['refferal'])->get('customer')->row_array();
			$exist_ref =  $this->db->where('refferal',$customer['id'])->get('customer')->row_array();
			//check ref
			
			 
			 
			//end check  ref
			 
			$this->db->trans_begin();
			// update order
			$this->db->where('id',$in['id'])->update('buy',array("status"=>$in['status'],"reads"=>1));
			if(empty($customer['id_level_earn']))
			{
				$reward_level = levelbot();
				if($reward_level>0)
				{
					$cde = $this->db->where('id',$reward_level)->get('level_earn')->row_array(); 
					if(isset($cde['id']))
					{
						 
						 
						$this->db->where('id',$customer['id'])->update('customer',array("id_level_earn"=>$cde['id'],"level_earn_info"=>json_encode($cde)));
						
					}
				}
			}
			if(!isset($exist_ref['id']))
			{
				$level = get_level($customer['id'],$check['total_coin']);
				$reward_level = is_level($level);
				 
				if($reward_level>0)
				{
					$cde = $this->db->where('id',$reward_level)->get('level_earn')->row_array(); 
					if(isset($cde['id']))
					{
						 
						 
						$this->db->where('id',$customer['id'])->update('customer',array("id_level_earn"=>$cde['id'],"level_earn_info"=>json_encode($cde)));
						
					}
				}
			}
			if(isset($ref['id']))
			{
				
				$level = get_level($ref['id'],$check['total_coin']);
				
				$reward_level = is_level($level);
				 
				if($reward_level>0)
				{
					$cd = $this->db->where('id',$reward_level)->get('level_earn')->row_array();
					 
					if(isset($cd['id']))
					{
						$total_ref = $check['total'] * ($cd['refferal_reward']/100);
						$rd = array();
						$rd['id_buy'] = $in['id'];
						$rd['total'] = $total_ref;
						$rd['ref_reward'] = $cd['refferal_reward'];
						$rd['id_level_earn'] = $cd['id'];
						$rd['level_earn_info'] = json_encode($cd);
						$rd['id_customer'] = $check['id_customer'];
						$rd['customer_info'] = json_encode($customer);
						$rd['to_customer'] = $ref['id'];
						$rd['to_customer_info'] = json_encode($ref);
						$this->db->insert('buy_ref',$rd);  
						$this->db->where('id',$ref['id'])->update('customer',array("id_level_earn"=>$cd['id'],"level_earn_info"=>json_encode($cd)));
						
					}
				}
			} 
			
			
			
			
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
	public function delete()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$id = $this->input->post('id',true);
			$this->db->trans_begin();
			if(is_array($id))
				$this->db->where_in('id',$id);
			else
				$this->db->where('id',$id);
			$this->db->delete('buy');
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
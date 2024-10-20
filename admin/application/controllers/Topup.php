<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		
		$in['use_hedaer'] = true;
		
		$in['title'] = ' Topup';
		$in['desc'] = 'you can manage your Topup here';
		$in['bread']['#'] = 'Topup';
		$in['bread'][site_url('manager/package')] = 'Topup';
		$in['tpl'] = 'topup/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_topup.id';
			$columns    = array(
			 
			array('db'=>"m_topup.pid",'dt'=>0,'alias'=>'pid'),
			array('db'=>"CONCAT(m_v_customer.name,'<br/>(',m_v_customer.email,')')",'dt'=>1,'alias'=>'custs'),
			 
			array('db'=>"m_topup.tanggal",'dt'=>2,'alias'=>'tanggal','formatter'=>function($d,$row){
				 return $d;
			}),
			array('db'=>"m_topup.coin_name",'dt'=>3,'alias'=>'coin_name'),
			array('db'=>"m_topup.network",'dt'=>4,'alias'=>'network'),
			 
			array('db'=>"m_topup.value_total",'dt'=>5,'alias'=>'value_total','formatter'=>function($d,$row){
				return number_format($d,2) ;
			}), 
			array('db'=>"m_topup.total",'dt'=>6,'alias'=>'total','formatter'=>function($d,$row){
				$cx = number_format($d,2);
				$fd = $cx;
				/*if($row->promo_value>0)
				{
					$fd = $cx; 
					$fd .= "<br/><small><b>Used Promo With value ".number_format($row->promo_value,2)." </b><small>";
					
				}*/
				return $fd ;
			}), 
			array('db'=>"m_topup.received_address",'dt'=>7,'alias'=>'received_address'),
			array('db'=>"m_topup.tx_hash",'dt'=>8,'alias'=>'tx_hash'),
			array('db'=>"m_topup.status",'dt'=>9,'alias'=>'status','formatter'=>function($d,$row){
				  
				 
				 $bg = array("orange","green","red");
				 $bg_color = isset($bg[$d])?"background:".$bg[$d]."; color:white;":"";
				if($row->buy==0)
				{
					 if($d==1)
					 $bg_color= "background:blue;color:white;";
					 return "<button class='btn btn-sm btn-status' style='".$bg_color."' data-ref='".$row->ids."'>".payments($d)."</button>";
				}
				 if($d==1)
				 {
					 return "<span class='btn' style='".$bg_color."'>".payments($d)."</span>";
				 }
				 return "<button class='btn btn-sm btn-status' style='".$bg_color."' data-ref='".$row->ids."'>".payments($d)."</button>";
			}), 
			 array('db'=>'m_topup.id','dt'=>10,'alias'=>'id','formatter'=>function($d,$row){
				if($row->buy==0)
				{
					return ' 
								 
								<button class="btn btn-xs btn-sm btn-danger btn-delete-users" type="button" data-toggle="tooltip" title="" data-original-title="Remove" data-ref="'.$row->ids.'"><i class="fa fa-times"></i></button>
							</span>	
							 ';
				}
				if($row->status!=1)
				{
					return ' 
								 
								<button class="btn btn-xs btn-sm btn-danger btn-delete-users" type="button" data-toggle="tooltip" title="" data-original-title="Remove" data-ref="'.$row->ids.'"><i class="fa fa-times"></i></button>
							</span>	
							 ';
				} 
			 }),
			 array('db'=>"m_topup.id",'dt'=>11,'alias'=>'ids'),
			 array('db'=>"m_topup.promo_value",'dt'=>12,'alias'=>'promo_value'),
			  array('db'=>"m_v_customer.buy",'dt'=>13,'alias'=>'buy'),
			);
			$table = 'm_topup inner join m_v_customer on (m_v_customer.id = m_topup.id_customer)';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			if(isset($_GET['status']))
			{
				if($_GET['status']!=-1)
				{
					$whereAll = "m_topup.status='".$_GET['status']."'";
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
			$check = $this->db->where('id',$in['id'])->get('topup')->row_array();
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
			 
			$this->db->trans_begin();
			// update order
			$this->db->where('id',$in['id'])->update('topup',array("status"=>$in['status'],"reads"=>1));
			
			 
			
			
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
			$this->db->delete('topup');
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
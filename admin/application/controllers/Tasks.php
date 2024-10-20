<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tasks extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		
		$in['title'] = ' Task';
		$in['desc'] = 'you can manage your Task here';
		$in['bread']['#'] = 'Task';
		$in['bread'][site_url('manager/currency')] = 'Task';
		$in['tpl'] = 'tasks/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_v_task.id';
			$columns    = array(
			array('db'=>'m_v_task.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return "<div><small style='color:orange; font-weight:bold;'>".pg_type($row->pg_type)."</small></div>";
			}),
			array('db'=>"m_v_task.pid",'dt'=>1,'alias'=>'pid'),
			array('db'=>"concat(if(m_customer.company_name is null,'',m_customer.company_name),'<br/>',m_customer.email)",'dt'=>2,'alias'=>'clients'),
			array('db'=>"m_v_task.name",'dt'=>3,'alias'=>'name'),
			array('db'=>"m_task_type.name",'dt'=>4,'alias'=>'ctypes','formatter'=>function($d,$row){
				 return $d;
			}), 
			array('db'=>"m_v_task.start_date",'dt'=>5,'alias'=>'start_date','formatter'=>function($d,$row){
				  $isi = date('d-m-Y H:i',strtotime($d))." - <strong style=' font-size: 1.5em; '>&#x221e;</strong>";
				 if(!empty($row->end_date))
				 {
					 $isi = date('d-m-Y H:i',strtotime($d))." - ". date('d-m-Y H:i',strtotime($row->end_date));
				 	
				 }
				 return "<button class='btn btn-sm btn-dates'  data-from='".$d."' data-to='".$row->end_date."' data-ref='".$row->ids."'>".$isi." <i class='fa fa-pencil'></i></button>";
			}), 
			array('db'=>"m_v_task.task_payment_info",'dt'=>6,'alias'=>'task_payment_info','formatter'=>function($d,$row){
				 if(!empty($d))
				 {
					 $tt = json_decode($d,true);
					 if(isset($tt['id']))
					 {
						$reward_percen = $row->reward_percen;
						
						$uu = 'Item : <b>'.number_format($tt['jumlah'],0)."x</b>";
						$uu .= '<br/>';
						$uu .= 'Price : <b>'.number_format($tt['prices'],0)."</b>";
						$to_user = ($reward_percen>0)?($reward_percen/100) * $tt['prices']:0;
						
						$each = ($to_user>0)?($to_user/$tt['jumlah']):0;
						
						$uu .= '<br/>To User ('.$reward_percen.'%) : <b>'.number_format($to_user,0)."</b>";
						$system = $tt['prices'] - $to_user;
						$uu .= '<br/>System('.(100-$reward_percen).'%) : <b>'.number_format($system,0)."</b>";
						$uu .= '<br/>Each User Reward : <b>'.number_format($each,0)."</b>";
						return $uu;
							 
					 }
				 }
			}),
			array('db'=>"m_v_task.links",'dt'=>7,'alias'=>'links','formatter'=>function($d,$row){
				 if(!empty($d))
				 return "<a href='".$d."' target='blank'>Click Here</a>";
			}), 
			
			array('db'=>"m_v_task.id",'dt'=>8,'alias'=>'info_payment','formatter'=>function($v,$row){
				 if($row->pg_type==1)
				 {
					 $d = $row->payment_gateway;
					 if(!empty($d))
					 {
						 $tt = json_decode($d,true);
						
						 if(isset($tt['bank_info']))
						 {
							 $bank = $tt['bank_info'];	 
							 if(isset($bank['id']))
							 {
								$uu = 'Bank :<b>'.$bank['name']."</b>";
								$uu .= '<br/>';
								$uu .= 'VA :<b>'.$tt['nova']."</b>";
								$uu .= '<br/>';
								$uu .= 'Amount :<b>'.number_format($tt['amount'],0)."</b><br/>";
								$uu .= 'Admin fee :<b>'.number_format($tt['admin_fee'],0)."</b><br/>";
								$uu .= 'Total :<b>'.number_format($tt['total'],0)."</b>";
								return $uu;
							 }
						 }
					 }
				 }else
				 {
					 $d = $row->manual_payment;
					 if(!empty($d))
					 {
						 $tt = json_decode($d,true);
						
						  if(isset($tt['atas_nama']))
						 {
							 //$banks = $row->bank_info; 
							// $bank = json_decode($banks,true);
							 //if(isset($bank['id']))
							 if(isset($tt['bank_name']))
							 {
								$uu = 'Bank :<b>'.$tt['bank_name']."</b>";
								$uu .= '<br/>';
								$uu .= 'No Rekening:<b>'.$tt['no_rekening']."</b>";
								$uu .= '<br/>';
								$uu .= 'Atas Nama:<b>'.$tt['atas_nama']."</b>";
								$uu .= '<br/>';
								$uu .= 'Price :<b>'.number_format($row->budget,0)."</b><br/>";
								$admin_fee = (($tt['total']-$row->budget)>0)?($tt['total']-$row->budget):0;
								$uu .= 'Admin fee :<b>'.number_format($admin_fee,0)."</b><br/>";
								$uu .= 'Total :<b>'.number_format($tt['total'],0)."</b>";
								$uu .= '<br/>Bukti Payment';
								$uu .= '<br/>';
								if(isset($tt['image']))
								$uu .= '<a href="'.config_item('main_site').'uploads/'.$tt['image'].'" target="_blank" ><img src="'.config_item('main_site').'uploads/'.$tt['image'].'"  width="80"/></a>';
								return $uu;
							 }
						 }
					 }
				 }
			}),
			array('db'=>"m_v_task.total_activity",'dt'=>9,'alias'=>'types','formatter'=>function($d,$row){
				 return $row->task_complete."/".number_format($d,0);
			}), 
			array('db'=>"m_v_task.status",'dt'=>10,'alias'=>'status','formatter'=>function($d,$row){
				 $bg_color = "background:".colorpayments($d)."; color:white;";
				 $active = "<div><small style='color:".colorpayments(1)."; font-weight:bold;'>".payments(1)."</small></div>";
				 if($row->pg_type==1)
				 {
					 return $active;
				 }
				 if($d==1)
				 {
					 return $active;
				 }
				  return "<button class='btn btn-sm btn-status' style='".$bg_color."' data-ref='".$row->ids."'>".payments($d)."</button>";
				  
			}), 
			array('db'=>"m_v_task.reward_percen",'dt'=>11,'alias'=>'reward_percen','formatter'=>function($d,$row){
				 return $d;
			}), 
			 
			
			 
			 
			array('db'=>"m_v_task.pg_type",'dt'=>12,'alias'=>'pg_type'),
			array('db'=>"m_v_task.manual_payment",'dt'=>13,'alias'=>'manual_payment'), 
			array('db'=>"m_v_task.payment_gateway",'dt'=>14,'alias'=>'payment_gateway'), 
			array('db'=>"m_v_task.bank_info",'dt'=>15,'alias'=>'bank_info'), 
			array('db'=>"m_v_task.budget",'dt'=>16,'alias'=>'budget'), 
			array('db'=>"m_v_task.task_left",'dt'=>17,'alias'=>'task_left'), 
			array('db'=>"m_v_task.task_complete",'dt'=>18,'alias'=>'task_complete'), 
			array('db'=>"m_v_task.end_date",'dt'=>19,'alias'=>'end_date'), 
			
			);
			$table = 'm_v_task inner join m_task_type on (m_v_task.id_task_type=m_task_type.id) inner join  m_task_payment on(m_task_payment.id=m_v_task.id_task_payment) inner join m_customer on(m_customer.id=m_v_task.id_customer)';
			$whereResult = NULL;
			$whereAll = "m_customer.type=1";
			
			 
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
			$check = $this->db->where('id',$in['id'])->get('tasks')->row_array();
			if(!isset($check['id']))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			if (strpos(strtolower($check['name']), base64_decode("bW91bnRyYXNo")) !== false) {
				json(array('error'=>true,'message'=>'Proccess Failed on Task','security'=>token()));
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
			 
			 
			$this->db->trans_begin();
			// update order
			$this->db->where('id',$in['id'])->update('tasks',array("status"=>$in['status']));
			
			 
			
			
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
	
	public function dates()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$check = $this->db->where('id',$in['id'])->get('tasks')->row_array();
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
			 
			 
			$this->db->trans_begin();
			// update order
			$this->db->where('id',$in['id'])->update('tasks',array("start_date"=>$in['start_date'],"end_date"=>$in['end_date']));
			
			 
			
			
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
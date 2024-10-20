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
			array('db'=>"m_v_task.name",'dt'=>2,'alias'=>'name'),
			array('db'=>"m_task_type.name",'dt'=>3,'alias'=>'ctypes','formatter'=>function($d,$row){
				 return $d;
			}), 
			array('db'=>"m_v_task.start_date",'dt'=>4,'alias'=>'start_date','formatter'=>function($d,$row){
				
				 if(!empty($row->end_date))
				 {
					  $html = date('d-m-Y H:i',strtotime($d))." - ". date('d-m-Y H:i',strtotime($row->end_date));
				 	return $html;
				 }
				 return date('d-m-Y H:i',strtotime($d))." - <strong style=' font-size: 1.5em; '>&#x221e;</strong>";
			}), 
			array('db'=>"m_v_task.task_payment_info",'dt'=>5,'alias'=>'task_payment_info','formatter'=>function($d,$row){
				 if(!empty($d))
				 {
					 $tt = json_decode($d,true);
					 if(isset($tt['id']))
					 {
						$uu = 'Item : <b>'.number_format($tt['jumlah'],0)."</b>";
						$uu .= '<br/>';
						$uu .= 'Price : <b>'.number_format($tt['prices'],0)."</b>";
						return $uu;
							 
					 }
				 }
			}),
			array('db'=>"m_v_task.links",'dt'=>6,'alias'=>'links','formatter'=>function($d,$row){
				 if(!empty($d))
				 return "<a href='".$d."' target='blank'>Click Here</a>";
			}), 
			
			array('db'=>"m_v_task.id",'dt'=>7,'alias'=>'info_payment','formatter'=>function($v,$row){
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
			array('db'=>"m_v_task.total_activity",'dt'=>8,'alias'=>'total_activity','formatter'=>function($d,$row){
				 return $row->task_complete."/".number_format($d,0);
			}), 
			array('db'=>"m_v_task.status",'dt'=>9,'alias'=>'status','formatter'=>function($d,$row){
				 
				 if($row->pg_type==1)
				 {
					 return "<div><small style='color:".colorpayments(1)."; font-weight:bold;'>".payments(1)."</small></div>";
				 }
				 return "<div><small style='color:".colorpayments($d)."; font-weight:bold;'>".payments($d)."</small></div>";
			}), 
			 
			 
			array('db'=>"m_v_task.pg_type",'dt'=>10,'alias'=>'pg_type'),
			array('db'=>"m_v_task.manual_payment",'dt'=>11,'alias'=>'manual_payment'), 
			array('db'=>"m_v_task.payment_gateway",'dt'=>12,'alias'=>'payment_gateway'), 
			array('db'=>"m_v_task.bank_info",'dt'=>13,'alias'=>'bank_info'), 
			array('db'=>"m_v_task.budget",'dt'=>14,'alias'=>'budget'),
			array('db'=>"m_v_task.task_left",'dt'=>15,'alias'=>'task_left'),
			array('db'=>"m_v_task.task_complete",'dt'=>16,'alias'=>'task_complete'), 
			array('db'=>"m_v_task.end_date",'dt'=>17,'alias'=>'end_date'), 
			
			);
			$table = 'm_v_task inner join m_task_type on (m_v_task.id_task_type=m_task_type.id) inner join  m_task_payment on(m_task_payment.id=m_v_task.id_task_payment)';
			$whereResult = NULL;
			$whereAll = "m_v_task.id_customer='".user_info('id')."'";
			
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function add()
	{
		  
		 
		$in['task_type'] = $this->db->where('displays',1)->get('task_type')->result_array();
		 
		$in['use_hedaer'] = true;
		$in['title'] = ' Task';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/currency')] = 'City';
		$in['tpl'] = 'tasks/form';
		 
		$this->load->view('manager/layout',$in);
	}
	 
	public function savefirst()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			if(isset($in['avatar_s']))
			{
				unset($in['avatar_s']);
				if($_FILES['avatar']['error']==0)
				{
					$name = get_unique_file($_FILES['avatar']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['avatar']['tmp_name'],config_item('upload_path').$name))
					{
						$in['image'] = $name;
					}
				}
			}
			$this->session->set_userdata('sospawn_task_create',$in);
			json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
			return;
		}
		show_404();
	} 
	
	public function step_payment()
	{
		  
		 
		$in['task_type'] = $this->db->where('displays',1)->get('task_type')->result_array();
		if(setting("pg_type")==0)
		{
			$banks = $this->db
			->select("m_bank.*")
			->join("m_bank","m_bank.id=m_bank_transfer.id_bank","inner")
			->where('m_bank_transfer.displays',1)->get('bank_transfer')->result_array(); 
		}else
		{
			$banks = $this->db
			->select("m_bank.*")
			 
			->where('m_bank.displays',1)->get('bank')->result_array(); 	
		}
		$in['banks'] = $banks;
		$in['use_hedaer'] = true;
		$in['title'] = ' Task';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/currency')] = 'City';
		$in['tpl'] = 'tasks/form-payment';
		 
		$this->load->view('manager/layout',$in);
	}
	public function savepayment()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$r = $this->session->userdata('sospawn_task_create');
			$r['bank_info'] = $in['bank'];
			$this->session->set_userdata('sospawn_task_create',$r);
			json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
			return;
		}
		show_404();
	} 
	public function step_end($params = "")
	{
		if(!empty($params))
		{
			$time = time();
			if(setting("pg_type")==0)
			{
				$rec = $this->db
				->select("m_bank.name as name,m_bank_transfer.*")
				->join("m_bank","m_bank.id=m_bank_transfer.id_bank","inner")
				->where('m_bank.id',$params)
				->where('m_bank_transfer.displays',1)->get('bank_transfer'); 
			}else
			{
				$rec = $this->db
				->select("m_bank.*")
				->where('m_bank.id',$params) 
				->where('m_bank.displays',1)->get('bank');
			}
			//$rec = $this->db->where('displays',1)->where('id',$params)->get('bank'); 
			if($rec->num_rows()>0)
			{
				$data = $rec->row_array();
				$r = $this->session->userdata('sospawn_task_create');
				
				$r['created_by'] = user_info('id');
				$r['created_on'] = $time;
				/*
				$payment_gateway = '{"nova":"713604000000008","amount":"52000"}';
				$y = json_decode($payment_gateway,true);
				$y['admin_fee'] = setting('admin_fee');
				$y['total'] = setting('admin_fee') + $y['amount'] ;
				$y['bank_info'] = $data;
				$r['payment_gateway'] = json_encode($y);
				$r['reward_percen'] =  setting('reward_percen');
				$r['pid'] = get_unique_tasks();
				$r['id_customer'] = user_info('id');
				$r['customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('customer')->row_array());
				$task_info = $this->db->where('id',$r["id_task_payment"])->get('task_payment')->row_array();
				$r['task_payment_info'] = json_encode($task_info);
				$r['budget'] = preg_replace("/[^0-9.]/", "", $r['prices']);
				$r['total_activity'] = $task_info['jumlah'];
				unset($r['prices']);
				$r['images'] = $r['image'];
				unset($r['image']);
				$this->db->insert('tasks',$r);
				*/
				$in['task_payment'] = $this->db->where('id',$r['id_task_payment'])->get('task_payment')->row_array(); 
				$r['bank_info'] = json_encode($data);
				$this->session->set_userdata('sospawn_task_create',$r);
				$in['data'] = $data;
				$in['carr'] = $r;
				$in['list_bank'] = $this->db
				->select("m_bank.*")
				
				->where('m_bank.displays',1)->get('bank')->result_array();
				$in['tpl'] = 'tasks/form-pg';
				if(setting("pg_type")==1)
				$in['tpl'] = 'tasks/form-pg-auto';
		 
				$this->load->view('manager/layout',$in);
				return;
				
			}
		}
		 
		show_404();
	}
	public function save_manual()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in_db = $this->input->post();
			$in = $this->session->userdata('sospawn_task_create'); 
			$this->db->trans_begin();
			$time = time();
			if(isset($in_db['avatar_s']))
			unset($in_db['avatar_s']);
			if($_FILES['img_screen']['error']==0)
			{
				$name = get_unique_file($_FILES['img_screen']['name']);
				if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['img_screen']['tmp_name'],config_item('upload_path').$name))
				{
					$in_db['image'] = $name;
				}
			} 
			
			if(isset($in_db['id_bank']))
			{
				$bank = $this->db
				->select("m_bank.*")
				->where('m_bank.id',$in_db['id_bank']) 
				->where('m_bank.displays',1)->get('bank')->row_array();
				$in_db['bank_name']	= isset($bank['name'])?$bank['name']:"";
				$in_db['bank_info'] = json_encode($bank);
			}
			$in['prices'] = preg_replace("/[^0-9.]/", "", $in['prices']);
			
			$in_db['total'] = ($in['prices'] + setting("admin_fee"));
			$in['manual_payment'] = json_encode($in_db);
			
			$in['pg_type'] = setting("pg_type");
			 
			#=======
			$in['reward_percen'] =  setting('reward_percen');
			$in['pid'] = get_unique_tasks();
			$in['id_customer'] = user_info('id');
			$in['customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('customer')->row_array());
			$task_info = $this->db->where('id',$in["id_task_payment"])->get('task_payment')->row_array();
			$in['task_payment_info'] = json_encode($task_info);
			$in['budget'] = preg_replace("/[^0-9.]/", "", $in['prices']);
			$in['total_activity'] = $task_info['jumlah'];
			unset($in['prices']);
			$in['images'] = $in['image'];
			unset($in['image']);
			#=====
			
			$in['created_by'] = user_info('id');
			$in['updated_by'] = user_info('id');
			$in['created_on'] = $time;
			$in['updated_on'] = $time;
			$this->db->insert('tasks',$in);
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
			$this->db->delete('currency');
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
	 
	public function match()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$id = $this->input->post('id',true);
			$this->db->where('id',$id);
			$data = $this->db->get('currency');
			if($data->num_rows()==1)
			{
				json(array('error'=>false,'message'=>'one data found','data'=>$data->row_array(),'security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'data not found','security'=>token()));
			return;
		}
		show_404();
	}
	
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$this->db->trans_begin();
			$time = time();
			unset($in['avatar_s']);
			if($_FILES['avatar']['error']==0)
			{
				$name = get_unique_file($_FILES['avatar']['name']);
				if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['avatar']['tmp_name'],config_item('upload_path').$name))
				{
					$in['icon'] = $name;
				}
			} 
			if(empty($in['id']))
			{
				$in['created_by'] = user_info('id');
				$in['updated_by'] = user_info('id');
				$in['created_on'] = $time;
				$in['updated_on'] = $time;
				$this->db->insert('currency',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('currency');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('currency',$in);
				}
				else
				{
					json(array('error'=>true,'message'=>'Data not found','security'=>token()));
					return;
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
	public function defaults()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$in = $this->input->post(); 
			$this->db->trans_begin();
			
			 
			if($in['displays']==1)
			{
				$in['displays']=0;
			}else
			{
				 
				$in['displays'] = 1;
				
			}
			 
			$this->db->where('id',$in['id'])
			->update('currency',array("displays"=>$in['displays']));
			
			if($this->db->trans_status() === FALSE)
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
	public function wds()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$in = $this->input->post(); 
			$this->db->trans_begin();
			
			 
			if($in['wd']==1)
			{
				$in['wd']=0;
			}else
			{
				 
				$in['wd'] = 1;
				
			}
			
			if($in['wd']==1)
			$this->db->update('currency',array("wd"=>0));
			 
			$this->db->where('id',$in['id'])
			->update('currency',array("wd"=>$in['wd']));
			
			if($this->db->trans_status() === FALSE)
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
	public function gettask_payment()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$id = $this->input->post('id',true);
			$this->db->where('id_task_type',$id);
			$data = $this->db->order_by('jumlah asc')->get('task_payment');
			if($data->num_rows()>0)
			{
				$arr = $data->result_array();
				for($i=0;$i<count($arr);$i++)
				{
					$arr[$i]['jumlah'] = number_format($arr[$i]['jumlah'],0);
					$arr[$i]['rprices'] = number_format($arr[$i]['prices'],0);
					$arr[$i]['lists'] = "Rp. ".number_format($arr[$i]['prices'],0)." - Count(<b>".$arr[$i]['jumlah']."</b>)";	
				}
				
				json(array('error'=>false,'message'=>'one data found','data'=>$arr,'security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'data not found','security'=>token()));
			return;
		}
		show_404();
	}
	#======= customer
	public function customer()
	{
		$in['use_hedaer'] = true;
		
		$in['title'] = ' Task Working By Customer';
		$in['desc'] = 'you can manage your Task here';
		$in['bread']['#'] = 'Task Complete By Customer';
		$in['bread'][site_url('manager/currency')] = 'Task';
		$in['tpl'] = 'tasks/customer';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist_customer()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_task_reward.id';
			$columns    = array(
			array('db'=>'m_task_reward.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"m_v_task.name",'dt'=>1,'alias'=>'name'),
			array('db'=>"m_task_type.name",'dt'=>2,'alias'=>'types','formatter'=>function($d,$row){
				 return $d;
			}), 
			array('db'=>"m_task_payment.jumlah",'dt'=>3,'alias'=>'jumlah'),
			
			array('db'=>'concat(m_v_customer.email," <br/>",m_v_customer.name)','dt'=>4,'alias'=>'info'),
			array('db'=>"from_unixtime(m_task_reward.created_on, '%Y-%m-%d')",'dt'=>5,'alias'=>'dsates'),
			array('db'=>'m_task_reward.os_detail','dt'=>6,'alias'=>'os_detail','formatter'=>function($d,$row){
				 if(!empty($d))
				 {
					$chtml = "";
					$rr = json_decode($d,true);
					if(isset($rr['os']))
					{
						$chtml .= "os:". $rr['os'];
						$chtml .= "<br/>mobile:". $rr['mobile']; 
						$chtml .= "<br/>osVersion:". $rr['osVersion']; 
						return $chtml;
						
					}
				 }
				 return $d;
			}), 
			array('db'=>'m_task_reward.status','dt'=>7,'alias'=>'statuss','formatter'=>function($d,$row){
				 
				 if($d==1)
				 {
					 return rewardstatus($d);
				 }
				  if($d==2)
				 {
					 $chtmls = "<b>".rewardstatus($d)."</b>";
					 $chtmls .= "<br/> <b>Reason</b>: <br/>".$row->reason;
					 return $chtmls;
				 }
				  return "<button class='btn btn-sm btn-status btn-info'   data-ref='".$row->ids."'>".rewardstatus($d)."</button>";
			}), 
			array('db'=>'m_task_reward.prove','dt'=>8,'alias'=>'prove','formatter'=>function($d,$row){
				 if(!empty($d))
				 {
					$chtml = "";
					$rr = json_decode($d,true);
					if(isset($rr['image']))
					{
						$chtml .= "Note:". $rr['prove'];
						$chtml .= "<br/><img src='".config_item('main_site')."uploads/".$rr['image']."' height='100'/>";
						return $chtml;
						
					}
				 }
				 return $d;
			}),
			array('db'=>"m_task_reward.reason",'dt'=>9,'alias'=>'reason'), 
			 
			 
			
			);
			$table = 'm_task_reward inner join m_v_task on(m_task_reward.id_tasks=m_v_task.id) inner join m_v_customer on(m_v_customer.id=m_task_reward.id_customer) inner join m_task_type on (m_v_task.id_task_type=m_task_type.id) inner join  m_task_payment on(m_task_payment.id=m_v_task.id_task_payment) ';
			$whereResult = NULL;
			$whereAll = "m_v_task.id_customer='".user_info('id')."'";
			
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
	}
	public function getlist_customer_()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_v_task.id';
			$columns    = array(
			array('db'=>'m_v_task.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"m_v_task.name",'dt'=>1,'alias'=>'name'),
			array('db'=>"m_task_type.name",'dt'=>2,'alias'=>'types','formatter'=>function($d,$row){
				 return $d;
			}), 
			array('db'=>"m_task_payment.jumlah",'dt'=>3,'alias'=>'jumlah'),
			array('db'=>'concat(m_v_customer.email," <br/>",m_v_customer.name)','dt'=>4,'alias'=>'info'),
			array('db'=>'concat(m_task_reward.os_device," <br/>",m_task_reward.os_detail)','dt'=>5,'alias'=>'os_detail'),
			array('db'=>'m_v_task.status','dt'=>6,'alias'=>'statuss','formatter'=>function($d,$row){
				 
				 return $a;
			}), 
			 
			 
			 
			
			);
			$table = 'm_task_reward inner join m_v_task on(m_task_reward.id_tasks=m_v_task.id) inner join m_v_customer on(m_v_customer.id=m_task_reward.id_customer) inner join m_task_type on (m_v_task.id_task_type=m_task_type.id) inner join  m_task_payment on(m_task_payment.id=m_v_task.id_task_payment) ';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
}
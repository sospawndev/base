<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Task_reward extends Smart_Controller
{
	private $_users;
	public function __construct()
	{
		parent::__construct();

		 
	}
	public function index()
	{
		 
		$in['use_hedaer'] = true;
		$in['arr'] = $this->db->get('task_type')->result_array();
		$in['title'] = 'Task Reward';
		$in['desc'] = 'you can manage your Task Payment here';
		$in['bread'][''] = 'Configuration';
		$in['bread'][site_url('manager/task_reward')] = 'Task Payment';
		$in['tpl'] = 'task_reward/main';
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
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
			array('db'=>"m_v_task.name",'dt'=>1,'alias'=>'name','formatter'=>function($d,$row){
				 $name = $d;
				  if(!empty($d))
				 return $name."<br/> <a href='".$row->links."' target='blank'>Click Here</a>";
				 return $d;
			}), 
			array('db'=>"m_task_type.name",'dt'=>2,'alias'=>'types','formatter'=>function($d,$row){
				  
				 return $d;
			}), 
			array('db'=>"concat(m_v_task.task_complete,'/',m_v_task.total_activity)",'dt'=>3,'alias'=>'jumlah'),
			
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
			array('db'=>'m_task_reward.rewards','dt'=>7,'alias'=>'rewards','formatter'=>function($d,$row){
				  
				 return $d;
			}),  
			array('db'=>'m_task_reward.txhash','dt'=>8,'alias'=>'txhash','formatter'=>function($d,$row){
				  
				 return "<a href='".$row->network_url.'tx/'.$d."' target='_blank'>".$d."</a>";
			}), 
			array('db'=>"m_task_reward.reason",'dt'=>9,'alias'=>'reason'), 
			array('db'=>"m_v_task.links",'dt'=>10,'alias'=>'links'), 
			array('db'=>"m_task_reward.network_url",'dt'=>11,'alias'=>'network_url'), 
			 
			 
			
			);
			 
			$table = 'm_task_reward inner join m_v_task on(m_task_reward.id_tasks=m_v_task.id) inner join m_v_customer on(m_v_customer.id=m_task_reward.id_customer) inner join m_task_type on (m_v_task.id_task_type=m_task_type.id) inner join  m_task_payment on(m_task_payment.id=m_v_task.id_task_payment) ';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			if(isset($_GET['status']))
			{
				if($_GET['status']!=-1)
				{
					$whereAll = "m_task_reward.status='".$_GET['status']."'";
				}
			}  
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
	}
	public function status()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$check = $this->db->where('id',$in['id'])->get('task_reward')->row_array();
			if(!isset($check['id']))
			{
				json(array('error'=>true,'message'=>'Failed','security'=>token()));
				return;
			}
			//
			//$price_coin = settings("price_coin"); 
			if($in['status']==1)
			{
				$v_task = $this->db->where('id',$check['id_tasks'])->get('v_task')->row_array();
				if(!isset($v_task['id']))
				{
					json(array('error'=>true,'message'=>'Failed','security'=>token()));
					return;
				}
				
				if($v_task['task_complete']>$v_task['total_activity'])
				{
					json(array('error'=>true,'message'=>'Failed Task count item left is more than activity, please reject','security'=>token()));
					return;
				}
				if($v_task['task_left']<=0)
				{
					json(array('error'=>true,'message'=>'Failed Task count item left is more than activity, please reject','security'=>token()));
					return;
				}
				
			}
			//
			//
			$customer =  $this->db->where('id',$check['id_customer'])->get('customer')->row_array();
			if(!isset($customer['id']))
			{
				json(array('error'=>true,'message'=>'Failed ','security'=>token()));
				return;
			}
			#== get ref  
			 
			$this->db->trans_begin();
			// update order
			if($customer['refferal']>0)
			{
				if($in['status']==1)
				{
					/*$checkv = $this->db
							 ->where('from_users',$customer['id'])
							 ->where('to_users',$customer['refferal'])
							 ->get('refferal_reward');
					if($checkv->num_rows()==0)
					*/
					$refferal_task = settings("refferal_task"); 
					$v_task = $this->db->where('status',1)->where('id_customer',$check['id_customer'])->get('task_reward')->num_rows();		 
					$checkv = $this->db
							 ->where('from_users',$customer['id'])
							 ->where('to_users',$customer['refferal'])
							 ->get('refferal_reward');
					 
					if($checkv->num_rows()==0 && $v_task>=$refferal_task)
					{
						$ref = $this->db->where('id',$customer['refferal'])->get('customer')->row_array();
						if(isset($ref['id']))
						{
							$arr = array();
							$arr['from_users'] = $customer['id'];
							$arr['from_users_info'] = json_encode($customer);
							$arr['to_users'] = $customer['refferal'];
							$arr['to_users_info'] = json_encode($ref);
							$arr['id_task_reward'] = $check['id'];
							$arr['rewards'] = settings('refferal_reward');
							$arr['dates'] = date('Y-m-d h:i:s');
							$this->db->insert('refferal_reward',$arr);
						}
					}
					
					
					
				}
			}
			$this->db->where('id',$in['id'])->update('task_reward',array("status"=>$in['status'],"reason"=>$in['reason']));
			if($in['status']==1)
			{
			#==== log
				$customer_vote = $this->db
								->where('id_customer',$customer['id'])
								->where('id_task_reward',$in['id'])
								->get('customer_vote');
				if($customer_vote->num_rows()==0)
				{				
								
					$vote = array();
					$vote['id_customer'] = $customer['id'];
					$vote['customer_info'] = json_encode($this->db->where('id',$customer['id'])->get('customer')->row_array());
					$vote['id_task_reward'] = $in['id'];
					$vote['task_reward_info'] = json_encode($this->db->where('id',$in['id'])->get('task_reward')->row_array());
					$vote['tgl'] = date('Y-m-d H:i:s');
					$vote['status'] = 1;
					$this->db->insert('customer_vote',$vote);
				}
					#==== log
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
					#=== update vote sum customer
					if($in['status']==1)
					{
						$vote_task = settings("vote_task"); 
						$votes_sum = $customer['votes'];
						$g = $this->db->where('status',1)->where('id_customer',$customer['id'])->get('customer_vote')->num_rows();
						
						if($g>=$vote_task)
						{
							$this->db->trans_begin();
							if($g>=$vote_task)
							{
								$this->db->where('id_customer',$customer['id'])->where('status',1)->update('customer_vote',array("status"=>0));
								$votes_sum +=1;
							}
							$this->db->where('id',$customer['id'])->update('customer',array("votes"=>$votes_sum));
							$this->db->trans_commit();
						}
					}
					#=== updated votes 
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	}  
}
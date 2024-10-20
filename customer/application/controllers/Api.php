<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
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
			$in = $c;
			//$in['urls'] = site_url("stats/forgot/".$c['activation_code']);
			$in['urls'] = base_url()."stats/forgot/".$in['activation_code'];
			$this->session->set_userdata('aleo_forgot',$in);	
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
			$this->session->set_userdata('aleo_customer',$check->row_array());
			json(array('error'=>false,'message'=>'Proses','security'=>token()));
			return;
		}
		show_404();
	}
	public function resendforgot()
	{
		$in = $this->session->userdata('aleo_forgot');
		send_mail_forgot($in);
	}
	public function syncs()
	{
		$in = array();
		$temps = $this->load->view('manager/syncs/main',$in,true); 
		json(array('error'=>false,'message'=>'Proses','security'=>token(),"temps"=>$temps));
		return;
	}
	public function check_syns()
	{
		$in = array();
		$temps = $this->load->view('manager/syncs/check',$in,true); 
		$links = $this->load->view('manager/syncs/links',$in,true); 
		//
		$opens = false;
		$vtiers = tiers();
								if(isset($vtiers['id']))
								{
									if($vtiers['ends']==0)
									{
										$percen = ($vtiers['phase_token']/$vtiers['total_supply'])*100;
										$starts = strtotime($vtiers['start_date']);
										$timenow = strtotime(date('Y-m-d H:i:s'));
										$ends = strtotime($vtiers['end_date']);
										if((round($percen,2)<100) && (($timenow>=$starts) && ($timenow<=$ends)))
										{ 
											$opens = true;
										}
									}
								}
		json(array('error'=>false,'message'=>'Proses','security'=>token(),"temps"=>$temps,"links"=>$links,"open"=>$opens,"data"=>$vtiers));
		return;
	} 
	public function get_by_province()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			return json(array('error'=>false,'data'=>$this->db->where('id_province',$id)->get('city')->result_array(),'message'=>'Proccess Done','security'=>token()));
		}
		show_404();
	}
	public function get_by_city()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$id = $this->input->post('id');
			return json(array('error'=>false,'data'=>$this->db->where('id_city',$id)->get('district')->result_array(),'message'=>'Proccess Done','security'=>token()));
		}
		show_404();
	}
	
	public function auto_screenshot()
	{
		if($this->input->get())
		{
			$in = $this->input->get();
			if(isset($in['key']))
			{
				if($in['key']=='8899123')
				{
					$vote_task = setting("vote_task"); 
					$all = $this->db
							//->where('id_customer',10)
							->where('status',4)
							->order_by("id", "asc")
							->get('task_reward')
							->result_array();
					for($i=0;$i<count($all);$i++)
					{
						 $status = $in['status'];
						$customer =  $this->db->where('id',$all[$i]['id_customer'])->get('customer')->row_array();
						$v_task = $this->db->where('id',$all[$i]['id_tasks'])->get('v_task')->row_array();
						if(isset($customer['id']) && isset($v_task['id']))
						{
							if($status==1)
							{
								
								 
									//$in['status'] = 2;
								
									
									if($v_task['task_complete']>=$v_task['total_activity'])
									{
										//$in['status'] = 2;
									}
									if($v_task['task_left']<=0)
									{
										$status = 2;
									}
								 
								if($customer['refferal']>0)
								{
									if($status==1)
									{
										$refferal_task = setting("refferal_task"); 
										$v_task = $this->db->where('status',1)->where('id_customer',$customer['id'])->get('task_reward')->num_rows();
										
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
												$arr['id_task_reward'] = $all[$i]['id'];
												$arr['rewards'] = setting('refferal_reward');
												$arr['dates'] = date('Y-m-d h:i:s');
												$this->db->trans_begin();	
												$this->db->insert('refferal_reward',$arr);
												$this->db->trans_commit();
											}
										}
										
										
										
									}
								}
								
							}
							$customer_vote = $this->db
									->where('id_customer',$customer['id'])
									->where('id_task_reward',$all[$i]['id'])
									->get('customer_vote');
							if($status==1)
							{		
								if($customer_vote->num_rows()==0)
								{				
									$this->db->trans_begin();			
									$vote = array();
									$vote['id_customer'] = $customer['id'];
									$vote['customer_info'] = json_encode($this->db->where('id',$customer['id'])->get('customer')->row_array());
									$vote['id_task_reward'] = $all[$i]['id'];
									$vote['task_reward_info'] = json_encode($all[$i]);
									$vote['tgl'] = date('Y-m-d H:i:s');
									$vote['status'] = 1;
									$this->db->insert('customer_vote',$vote);
									$this->db->trans_commit();
									#=========================
									
									$votes_sum = $customer['votes'];
									$g = $this->db->where('status',1)->where('id_customer',$customer['id'])->get('customer_vote')->num_rows();
									
									if($g>=$vote_task)
									{
										$this->db->trans_begin();
										if($g>=$vote_task)
										{
											$this->db->where('id_customer',$customer['id'])->where('status',1)->update('customer_vote',array("status"=>0));
											$uu = round(($g/$vote_task),1);
											$op = explode(".",$uu);
											$vlk = isset($op[0])?$op[0]:0;
											$votes_sum += ($vlk>0)?$vlk:0;
										}
										$this->db->where('id',$customer['id'])->update('customer',array("votes"=>$votes_sum));
										$this->db->trans_commit();
									}
									#=======
									
									
									#=======
								}
							}
							$this->db->trans_begin();
							$this->db->where('id',$all[$i]['id'])->update('task_reward',array("status"=>$status));
							$this->db->trans_commit(); 
						}
					}
					return;
				}
			}
		}
		show_404();
	}
	 
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends Smart_Controller {

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
		$in['bread']['#'] = 'Task';
		$in['title'] = ""; 
		$task_type = $this->db->where('displays',1)->get('task_type')->result_array();
		$in['task_type'] = $task_type; 
		
		$waktu = date('Y-m-d h:i:s');
		 
		$completed = array();
		
		$in['tpl'] = "tasks/main";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function upcoming($record=0)
	{
		$this->load->helper('url');
         $this->load->library('pagination');
		$waktu = date('Y-m-d h:i:s');
		$recordPerPage = 10;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
		$counts = $this->db
					->select('count(id) as allcount')
					->where("start_date>NOW()")
					->where("end_date>=NOW()")
					
					->where('status',1)->get('tasks')->row_array();
		$recordCount = isset($counts['allcount'])?$counts['allcount']:0;
		$arr =  $this->db
					->where("start_date>NOW()")
					->where("end_date>=NOW()")
					->where('status',1)
					->limit($recordPerPage,$record)
					
					->get('tasks')->result_array();
		for($i=0;$i<count($arr);$i++)
		{
			$arr[$i]['task_type'] = $this->db->where('id',$arr[$i]['id_task_type'])->get('task_type')->row_array();	
			$arr[$i]['reward'] = 0;
			$arr[$i]['task_payment_arr'] = array();
			$tt = json_decode($arr[$i]['task_payment_info'],true);
			if(isset($tt['id']))
			{
				$arr[$i]['task_payment_arr'] = $tt;
				$arr[$i]['reward'] = calc_each_user($arr[$i]['reward_percen'],$tt);
			}
			$arr[$i]['task_complete'] = $this->db
									->where('status',1)
									->where('id_tasks',$arr[$i]['id'])->get('task_reward')
									->num_rows();
		}
		$config = $this->style_pagination();
		$config['base_url'] = base_url().'index.php/tasks/upcoming';
      	$config['use_page_numbers'] = TRUE;
		//$config['next_link'] = 'Next';
		//$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['arr'] = $arr;
		 
		$data['temps'] = $this->load->view('manager/tasks/item_upcoming', $data, true);
		 
		//$data['sql'] = $this->db->last_query();
		$data['config'] = $config;
		echo json_encode($data);	
		return;	
	}
	
	public function on_going($record=0)
	{
		$this->load->helper('url');
         $this->load->library('pagination');
		$waktu = date('Y-m-d h:i:s');
		$recordPerPage = 10;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
		$counts = $this->db
		
					->select('count(id) as allcount')
					->where("start_date<=NOW()")
					->where("end_date>=NOW()")
					->where("m_v_task.id not in (select id_tasks from m_task_reward where id_customer='".user_info('id')."' and (status=1 or status=2))")
					->where('status',1)
					->where('task_left>0')
					->get('v_task')->row_array();
		$recordCount = isset($counts['allcount'])?$counts['allcount']:0;
		$arr =  $this->db
					->where("start_date<=NOW()")
					->where("end_date>=NOW()")
					->where('status',1)
					->where("m_v_task.id not in (select id_tasks from m_task_reward where id_customer='".user_info('id')."' and (status=1 or status=2))")
					->where('task_left>0')
					->limit($recordPerPage,$record)
					
					->get('v_task')->result_array();
		for($i=0;$i<count($arr);$i++)
		{
			$arr[$i]['task_type'] = $this->db->where('id',$arr[$i]['id_task_type'])->get('task_type')->row_array();	
			$arr[$i]['reward'] = 0;
			$arr[$i]['task_payment_arr'] = array();
			$tt = json_decode($arr[$i]['task_payment_info'],true);
			if(isset($tt['id']))
			{
				$arr[$i]['task_payment_arr'] = $tt;
				$arr[$i]['reward'] = calc_each_user($arr[$i]['reward_percen'],$tt);
			}
			$arr[$i]['task_complete'] = $this->db
									->where('status',1)
									->where('id_tasks',$arr[$i]['id'])->get('task_reward')
									->num_rows();
			#======
			$check = $this->db->where('id_tasks',$arr[$i]['id'])
					->where('id_customer',user_info('id'))
					->get("task_reward")->row_array();
					
				$in = array(); 
				$arr[$i]['user_reward'] = array();
				$arr[$i]['user_reward']['status']=0;
				if(isset($check['id']))
				{
					$arr[$i]['user_reward'] = $check;
				}						
		}
		$config = $this->style_pagination();
		$config['base_url'] = base_url().'index.php/tasks/on_going';
      	$config['use_page_numbers'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['arr'] = $arr;
		 
		$data['temps'] = $this->load->view('manager/tasks/item_ongoing', $data, true);
		 
		//$data['sql'] = $this->db->last_query();
		$data['config'] = $config;
		echo json_encode($data);	
		return;	
	}
	#completes
	public function completes($record=0)
	{
		$this->load->helper('url');
         $this->load->library('pagination');
		$waktu = date('Y-m-d h:i:s');
		$recordPerPage = 10;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
		$counts = $this->db
					->select('count(id) as allcount')
					->where("start_date<=NOW()")
					
					->where("m_tasks.id in (select id_tasks from m_task_reward where id_customer='".user_info('id')."' and (status=1 or status=2))")
					->or_where("end_date<=NOW()")
					->where('status',1)->get('tasks')->row_array();
		$recordCount = isset($counts['allcount'])?$counts['allcount']:0;
		$arr =  $this->db
					->where("start_date<=NOW()")
					->where('status',1)
					->where("m_tasks.id in (select id_tasks from m_task_reward where id_customer='".user_info('id')."' and (status=1 or status=2))")
					->or_where("end_date<=NOW()")
					->limit($recordPerPage,$record)
					
					->get('tasks')->result_array();
		for($i=0;$i<count($arr);$i++)
		{
			$arr[$i]['task_type'] = $this->db->where('id',$arr[$i]['id_task_type'])->get('task_type')->row_array();	
			$arr[$i]['reward'] = 0;
			$arr[$i]['task_payment_arr'] = array();
			$tt = json_decode($arr[$i]['task_payment_info'],true);
			if(isset($tt['id']))
			{
				$arr[$i]['task_payment_arr'] = $tt;
				$arr[$i]['reward'] = calc_each_user($arr[$i]['reward_percen'],$tt);
			}
			$arr[$i]['task_complete'] = $this->db
									->where('status',1)
									->where('id_tasks',$arr[$i]['id'])->get('task_reward')
									->num_rows();
			#======
			$check = $this->db->where('id_tasks',$arr[$i]['id'])
					->where('id_customer',user_info('id'))
					->get("task_reward")->row_array();
					
				$in = array(); 
				$arr[$i]['user_reward'] = array();
				$arr[$i]['user_reward']['status']=0;
				if(isset($check['id']))
				{
					$arr[$i]['user_reward'] = $check;
				}						
		}
		$config = $this->style_pagination();
		$config['base_url'] = base_url().'index.php/tasks/on_going';
      	$config['use_page_numbers'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['arr'] = $arr;
		 
		$data['temps'] = $this->load->view('manager/tasks/item_completes', $data, true);
		 
		//$data['sql'] = $this->db->last_query();
		$data['config'] = $config;
		echo json_encode($data);	
		return;	
	}
	private function style_pagination()
	{
		$config = array();
		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		return $config;	
	}
	#=== detail
	public function details($params)
	{
		if(!empty($params))
		{
			$rec = $this->db->where('task_left>0')->where('id',$params)->get('v_task');
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();	
				$data['task_type'] = $this->db->where('id',$data['id_task_type'])->get('task_type')->row_array();	
				$data['reward'] = 0;
				$data['task_payment_arr'] = array();
				$tt = json_decode($data['task_payment_info'],true);
				if(isset($tt['id']))
				{
					$data['task_payment_arr'] = $tt;
					$data['reward'] = calc_each_user($data['reward_percen'],$tt);
				}
				$data['task_complete'] = $this->db
										->where('status',1)
										->where('id_tasks',$data['id'])->get('task_reward')
										->num_rows();
				$check = $this->db->where('id_tasks',$data['id'])
					->where('id_customer',user_info('id'))
					->get("task_reward")->row_array();
					
				$in = array(); 
				$data['user_reward'] = array();
				$data['user_reward']['status']=0;
				if(isset($check['id']))
				{
					$data['user_reward'] = $check;
				}
				 
				$in['data'] = $data;
				$in['tpl'] = "tasks/detail";
				$this->load->view('manager/layout',$in);
				return; 
			}
		}
		show_404();
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$time = time();
			$in = $this->input->post();
			 
			$rec = $this->db->where('task_left>0')->where('id',$in['id'])->get('v_task');
			if($rec->num_rows()==0)
			{
				json(array('error'=>true,'message'=>'Data not found','security'=>token()));
				return;
			}
			$data = $rec->row_array();
			$check = $this->db->where('id_tasks',$data['id'])
					->where('id_customer',user_info('id'))
					->get("task_reward");
			if($check->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Data has been entry','security'=>token()));
				return;
			}		
			$r = array();
			$r['status'] = 3;
			$r['id_customer'] = user_info('id');
			$r['customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('customer')->row_array());
			$r['id_tasks'] = $in['id'];
			$r['tasks_info'] = json_encode($data);
			$tt = json_decode($data['task_payment_info'],true);
			if(!isset($tt['id']))
			{
				json(array('error'=>true,'message'=>'Data not found','security'=>token()));
				return;
				
			}
			$r['rewards'] = calc_each_user($data['reward_percen'],$tt);
			$r['tgl'] = date('Y-m-d h:i:s');
			$r['os_device'] = $in['osc']['os'];
			$r['os_detail'] = json_encode($in['osc']);
			
			$r['tgl'] = date('Y-m-d h:i:s');
			$r['created_by'] = user_info('id');
			$r['updated_by'] = user_info('id');
			$r['created_on'] = $time;
			$r['updated_on'] = $time;
			$this->db->insert('task_reward',$r);
			$id = $this->db->insert_id(); 
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			else
			{
				$this->db->trans_commit();
				json(array('error'=>false,'message'=>'Proccess Done','status'=>rewardstatus($r['status']),"id"=>$id,'security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
	}
	public function updatescreenshot()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$time = time();
			$in = $this->input->post();
			unset($in['avatar_s']);
			if($_FILES['img_screen']['error']==0)
			{
				$name = get_unique_file($_FILES['img_screen']['name']);
				if(move_uploaded_file($_FILES['img_screen']['tmp_name'],$this->config->item('upload_path').$name))
				{
					$in['image'] = $name;
				}
			} 
			if(!isset($in['image']))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;	
			}
			$r = array();
			$r['status'] = 4;
			$r['prove'] = json_encode($in);
			$this->db->where('id',$in['id'])->update('task_reward',$r);
			 
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
		}
	}
}


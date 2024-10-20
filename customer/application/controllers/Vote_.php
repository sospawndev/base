<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends Smart_Controller {

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
		/* $vote_task = user_balance('votes');
		 if($vote_task<=0)
		 {
			redirect('page-error/vote-message');
			return;	 
		 }
		 */
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
		
		$in['tpl'] = "vote/main";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function upcoming($record=0)
	{
		$this->load->helper('url');
         $this->load->library('pagination');
		$waktu = date('Y-m-d h:i:s');
		$recordPerPage = 2;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
		$counts = $this->db
					->select('count(id) as allcount')
					->where("start_dates>NOW()")
					->where("end_dates>=NOW()")
					
					->get('v_vote')->row_array();
		$recordCount = isset($counts['allcount'])?$counts['allcount']:0;
		$arr =  $this->db
					->where("start_dates>NOW()")
					->where("end_dates>=NOW()")
					->limit($recordPerPage,$record)
					
					->get('v_vote')->result_array();
		$reward = setting("vote_reward");			
		for($i=0;$i<count($arr);$i++)
		{
			$vote_option = $this->db->where('id_vote',$arr[$i]['id'])->get('vote_option')->result_array();
			$sum_vote = $this->db->where('id_vote',$arr[$i]['id'])->get('vote_reward')->num_rows();
			for($x=0;$x<count($vote_option);$x++)
			{
				$cc = $this->db->where('id_vote_option',$vote_option[$x]['id'])->get('vote_reward')->num_rows();
				$cals = ($cc>0 && $sum_vote>0)?($cc/$sum_vote)*100:0;
				$vote_option[$x]['percen'] = round($cals,0); 
			}
			$arr[$i]['vote_option'] = $vote_option;	
			 
			$arr[$i]['reward'] = $reward;
			$arr[$i]['task_payment_arr'] = array();
			 
			$arr[$i]['vote_complete'] = $this->db
									->where('id_vote',$arr[$i]['id'])->get('vote_reward')
									->num_rows();
		}
		$config = $this->style_pagination();
		$config['base_url'] = base_url().'index.php/vote/upcoming';
      	$config['use_page_numbers'] = TRUE;
		//$config['next_link'] = 'Next';
		//$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['arr'] = $arr;
		 
		$data['temps'] = $this->load->view('manager/vote/item_upcoming', $data, true);
		 
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
		$recordPerPage = 2;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
		$counts = $this->db
		
					->select('count(id) as allcount')
					->where("start_dates<=NOW()")
					->where("end_dates>=NOW()")
					->where("m_v_vote.id not in (select id_vote from m_vote_reward where id_customer='".user_info('id')."')")
					 
					->order_by("id desc")
					->get('v_vote')->row_array();
		$recordCount = isset($counts['allcount'])?$counts['allcount']:0;
		$arr =  $this->db
					->where("start_dates<=NOW()")
					->where("end_dates>=NOW()")
					->where("m_v_vote.id not in (select id_vote from m_vote_reward where id_customer='".user_info('id')."')")
					
					->order_by("id desc")
					->limit($recordPerPage,$record)
					
					->get('v_vote')->result_array();
		$reward = setting("vote_reward");			
		for($i=0;$i<count($arr);$i++)
		{
			$vote_option = $this->db->where('id_vote',$arr[$i]['id'])->get('vote_option')->result_array();
			$sum_vote = $this->db->where('id_vote',$arr[$i]['id'])->get('vote_reward')->num_rows();
			for($x=0;$x<count($vote_option);$x++)
			{
				$cc = $this->db->where('id_vote_option',$vote_option[$x]['id'])->get('vote_reward')->num_rows();
				$cals = ($cc>0 && $sum_vote>0)?($cc/$sum_vote)*100:0;
				$vote_option[$x]['percen'] = round($cals,0); 
			}
			$arr[$i]['vote_option'] = $vote_option;	
			
			$arr[$i]['reward'] = $reward;
			$arr[$i]['task_payment_arr'] = array();
			 
			$arr[$i]['vote_complete'] = $this->db
									->where('id_vote',$arr[$i]['id'])->get('vote_reward')
									->num_rows();
			#======
			$check = $this->db->where('id_vote',$arr[$i]['id'])
					->where('id_customer',user_info('id'))
					->get("vote_reward")->row_array();
					
				$in = array(); 
				$arr[$i]['user_reward'] = array();
				$arr[$i]['user_reward']['status']=0;
				if(isset($check['id']))
				{
					$arr[$i]['user_reward'] = $check;
				}						
		}
		 
		$config = $this->style_pagination();
		$config['base_url'] = base_url().'index.php/vote/on_going';
      	$config['use_page_numbers'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['arr'] = $arr;
		 
		$data['temps'] = $this->load->view('manager/vote/item_ongoing', $data, true);
		 
		  
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
		$recordPerPage = 2;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
		$counts = $this->db
					->select('count(id) as allcount')
					->where("start_dates<=NOW()")
					
					->where("m_v_vote.id in (select id_vote from m_vote_reward where id_customer='".user_info('id')."')")
					->or_where("end_dates<=NOW()")
				 
					->order_by("id desc")
					->get('v_vote')->row_array();
		$recordCount = isset($counts['allcount'])?$counts['allcount']:0;
		$arr =  $this->db
					->where("start_dates<=NOW()")
					->where("m_v_vote.id in (select id_vote from m_vote_reward where id_customer='".user_info('id')."' )")
					->or_where("end_dates<=NOW()")
					->order_by("id desc")
					->limit($recordPerPage,$record)
					
					->get('v_vote')->result_array();
		$reward = setting("vote_reward");
		for($i=0;$i<count($arr);$i++)
		{
			$vote_option = $this->db->where('id_vote',$arr[$i]['id'])->get('vote_option')->result_array();
			$sum_vote = $this->db->where('id_vote',$arr[$i]['id'])->get('vote_reward')->num_rows();
			for($x=0;$x<count($vote_option);$x++)
			{
				$cc = $this->db->where('id_vote_option',$vote_option[$x]['id'])->get('vote_reward')->num_rows();
				$cals = ($cc>0 && $sum_vote>0)?($cc/$sum_vote)*100:0;
				$vote_option[$x]['percen'] = round($cals,0); 
			}
			$arr[$i]['vote_option'] = $vote_option;	
			
			$arr[$i]['reward'] = $reward ;
			 
			$arr[$i]['vote_complete'] = $this->db
									->where('id_vote',$arr[$i]['id'])->get('vote_reward')
									->num_rows();
			#======
			$check = $this->db
					->select("m_vote_reward.*,m_vote_option.name as vote_name")
					->join('m_vote_option','m_vote_option.id=m_vote_reward.id_vote_option','inner')
					->where('m_vote_reward.id_vote',$arr[$i]['id'])
					->where('id_customer',user_info('id'))
					->get("vote_reward")->row_array();
					
				$in = array(); 
				$arr[$i]['user_reward'] = array();
				$arr[$i]['user_reward']['status']=0;
				if(isset($check['id']))
				{
					$arr[$i]['user_reward'] = $check;
				}						
		}
		$config = $this->style_pagination();
		$config['base_url'] = base_url().'index.php/vote/completes';
      	$config['use_page_numbers'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['arr'] = $arr;
		 
		$data['temps'] = $this->load->view('manager/vote/item_completes', $data, true);
		  
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
			$rec = $this->db->where('id',$params)->get('v_vote');
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();	
				$data['vote_option'] = $this->db->where('id_vote',$data['id'])->get('vote_option')->result_array();	
				
				$vote_option = $this->db->where('id_vote',$data['id'])->get('vote_option')->result_array();
				$sum_vote = $this->db->where('id_vote',$data['id'])->get('vote_reward')->num_rows();
				for($x=0;$x<count($vote_option);$x++)
				{
					$cc = $this->db->where('id_vote_option',$vote_option[$x]['id'])->get('vote_reward')->num_rows();
					$cals = ($cc>0 && $sum_vote>0)?($cc/$sum_vote)*100:0;
					$vote_option[$x]['percen'] = round($cals,0); 
				}
				$data['vote_option'] = $vote_option;	
				
				$reward = setting("vote_reward");
				$data['reward'] = $reward;
				 
				$data['vote_complete'] = $this->db
									->where('id_vote',$data['id'])->get('vote_reward')
									->num_rows();
				$check = $this->db->where('id_vote',$data['id'])
					->where('id_customer',user_info('id'))
					->get("vote_reward")->row_array();
					
				$in = array(); 
				$data['user_reward'] = array();
				$data['user_reward']['status']=0;
				if(isset($check['id']))
				{
					$data['user_reward'] = $check;
				}
				 
				$in['data'] = $data;
				$in['tpl'] = "vote/detail";
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
			$vote_task = user_balance('votes');
			if($vote_task<=0)
			{
				json(array('error'=>true,'message'=>'No Vote is Allowed','security'=>token()));
				return;
			}
			$osc = $in['osc'];
			$osc = json_decode($osc,true);
			if(!isset($osc['os']))
			{
				json(array('error'=>true,'message'=>'No OS is respon to server','security'=>token()));
				return;
			}
			$data = $this->db->where('id',$in['id_vote'])->get('vote')->row_array();
			if(!isset($data['id']))
			{
				json(array('error'=>true,'message'=>'No Data','security'=>token()));
				return;
			}
			$check = $this->db->where('id_vote',$in['id_vote'])
					->where('id_customer',user_info('id'))
					->get("vote_reward");
			if($check->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Data has been entry','security'=>token()));
				return;
			}		
			$r = array();
			//$r['status'] = 1;
			$r['id_vote_option'] = $in['id_vote_option'];
			$r['vote_option_info'] =  json_encode($this->db->where('id',$in['id_vote_option'])->get('vote_option')->row_array());
			
			$r['id_customer'] = user_info('id');
			$r['customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('customer')->row_array());
			$r['id_vote'] = $data['id'];
			$r['vote_info'] = json_encode($data);
			$reward = setting("vote_reward"); 
			$r['reward'] = $reward;
			$r['tgl'] = date('Y-m-d h:i:s');
			$r['os_device'] = $osc['os'];
			$r['os_detail'] = json_encode($osc);
			
			$r['tgl'] = date('Y-m-d h:i:s');
			$r['created_by'] = user_info('id');
			$r['updated_by'] = user_info('id');
			$r['created_on'] = $time;
			$r['updated_on'] = $time;
			$this->db->insert('vote_reward',$r);
			$id = $this->db->insert_id(); 
				#votes	
				$votes_sum = user_balance('votes');
				if($votes_sum>0)
				{
					$votes_sum -=1;
					#votes
					$this->db->where('id',user_info('id'))->update('customer',array("votes"=>$votes_sum));
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
				json(array('error'=>false,'message'=>'Proccess Done',"id"=>$id,'security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
	}
	 
}


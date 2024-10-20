<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Smart_Controller {

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
		 
		if(empty(user_balance('name')))
		{
			redirect("profile");
			return;	
		}
		$in = array(); 
		$in['topup'] =  $this->db						
						->where('id_customer',user_info('id')) 			
						->order_by("id desc")
						->limit(1)
						->get("topup")->row_array();
		
		
		$datenow = date('Y-m-d H:i:s');
		
		$in['tp_pending'] = $this->db->where('id_customer',user_info("id"))->where('status',0)->get('topup')->num_rows(); 
		$in['tasks'] = $this->db
						->where('status',1)
						->where("start_date<=NOW()")
						->where("end_date>=NOW()")
						->where("m_v_task.id not in (select id_tasks from m_task_reward where id_customer='".user_info('id')."' and (status=1 or status=2))")
						->where('task_left>0') 
						->get('v_task')->num_rows();
		$in['tasks_completed'] = $this->db
						->where('status',1)
						->where("m_v_task.id in (select id_tasks from m_task_reward where id_customer='".user_info('id')."' and (status=1))")
						->get('v_task')->num_rows();	
		
		#vote
		$in['vote'] = $this->db
						 
						->where("start_dates<=NOW()")
						->where("end_dates>=NOW()")
						->where("m_v_vote.id not in (select id_vote from m_vote_reward where id_customer='".user_info('id')."' )")
						 
						->get('v_vote')->num_rows();
		$in['vote_completed'] = $this->db
						 
						->where("m_v_vote.id in (select id_vote from m_vote_reward where id_customer='".user_info('id')."' )")
						->get('v_vote')->num_rows();
		#end vote		
						
		 
		$in['bread']['#'] = 'Dashboard';
		
		$in['title'] = ""; 
		$in['tpl'] = "home/dashboard";
		$this->load->view('manager/layout',$in);
		return; 
	}
	 
	
}


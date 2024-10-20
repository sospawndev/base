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
		
		$in = array();
		
		
		$in['task_complete'] = $this->db->where('id_customer',user_info('id'))->where('status',1)->where('task_left=0')->get("v_task")->num_rows();
		$in['task_progress'] = $this->db->where('id_customer',user_info('id'))->where('status',1)->where('task_left>0')->get("v_task")->num_rows();
		$in['task_cancel'] = $this->db->where('id_customer',user_info('id'))->where('status',2)->get("v_task")->num_rows();
		$in['task_wait'] = $this->db->where('id_customer',user_info('id'))->where('status',0)->get("v_task")->num_rows();
		$in['task'] = $this->db->where('id_customer',user_info('id'))->limit(10)->order_by('id desc')->get("v_task")->result_array(); 
			
		$in['bread']['#'] = 'Dashboard';
		
		$in['title'] = ""; 
		$in['tpl'] = "home/main";
		$this->load->view('manager/layout',$in);
		return; 
	}
	 
	
}


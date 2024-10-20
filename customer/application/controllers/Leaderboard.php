<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaderboard extends Smart_Controller {

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
		$in['arr'] = $this->db
					 ->where('total_task>0')
					  //->where('status',1)
					 ->order_by('rewards desc')->limit(20)->get("v_customer")->result_array(); 
		$in['bread']['#'] = 'Task';
		
		$in['title'] = ""; 
		
		$in['task_type'] = $this->db->where('displays',1)->get('task_type')->result_array();
		
		$in['tpl'] = "leaderboard/main";
		$this->load->view('manager/layout',$in);
		return; 
	}
	 
	
}


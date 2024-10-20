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
		$in['task_total'] = $this->db->select("count(id) as total")
									  ->where('status',1)
									  ->get('v_task')->row_array();			
		$in['wait_total'] = $this->db->select("count(id) as total")
									  ->where('status',0)
									  ->get('v_task')->row_array();			
		$in['reject_total'] = $this->db->select("count(id) as total")
									  ->where('status',2)
									  ->get('v_task')->row_array();		
		
		$in['tf_total'] = $this->db->select("sum(full_total) as total")
									  ->get('transfer')->row_array();	
		$in['task_reward'] = $this->db->select("sum(rewards) as total")
									 
									  ->get('task_reward')->row_array();
		
		$in['vote_reward'] = $this->db->select("sum(reward) as total")
									 
									  ->get('vote_reward')->row_array();							  	
		
									  
		$in['customer'] = $this->db->select("count(id) as total")
									  ->get('v_customer')->row_array();	
		$in['level_earn'] = $this->db->select("count(id_level_earn) as total")
									  ->where('id_level_earn>0')
									  ->get('v_customer')->row_array();								  						  		
		
		$in['balance_total'] = $this->db->select("sum(balance) as total")
									  ->get('v_customer')->row_array();		
		
		
		
		  							  	
		$in['bread']['#'] = 'Dashboard';
		
		$in['title'] = ""; 
		$in['tpl'] = "home/dashboard";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function charts()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$year = $this->input->post('tahun',true);
			$out = array();
			$bulan = array();
			for($i=1;$i<=12;$i++)
			{
				$c = $this->db
				->select('sum(budget) as total')
				->where('MONTH(FROM_UNIXTIME(created_on))',$i)
				->where('Year(FROM_UNIXTIME(created_on))',$year)
				->where('status',1)
				->get('v_task')
				->row_array();
				$s = isset($c['total'])?$c['total']:0;
				$out[count($out)] = array("label"=>bulan_name($i),"value"=>$s);  
				
			}
			json(array('error'=>false,'message'=>'Data','security'=>token(),"data"=>$out));
			return;		
		}
		show_404();
	} 
	
}


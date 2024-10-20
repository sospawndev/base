<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refferal extends Smart_Controller {

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
		
		$ref = $this->db
						->where('refferal',user_info('id'))
						->get('v_customer')->result_array();
		for($i=0;$i<count($ref);$i++)
		{
			$cc = $this->db
						->where('from_users',$ref[$i]['id'])
						->get('refferal_reward')->row_array();
			$ref[$i]['reward'] = isset($cc['rewards'])?$cc['rewards']:0;	
		}
		$in['ref'] = $ref;
		$in['title'] = ""; 
		$in['tpl'] = "activity/refferal";
		$this->load->view('manager/layout',$in);
		return; 
	}
	 
	 
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oaths extends CI_Controller {

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
	 
	 
	public function views($ids = "")
	{
		$this->load->library('facebook');
		$refferal = str_replace("A-","",$ids);
		$refferal = preg_replace("/[^0-9.]/", "", $ids);
		$check_ref = $this->db->where('pid',$refferal)->get('v_customer');
		if($check_ref->num_rows()>0)
		{
			$data = $check_ref->row_array();
			$in = array();
			$this->session->set_userdata('sospawn_ref',$data); 
			$in['google_url'] = $this->googleplus->loginURL(); 
			$in['facebook_url'] =  $this->facebook->loginURL(); 
			$in['refs'] = $ids; 
			$in['data'] = $data;
			$in['title'] = "Logins";
			$this->load->view('manager/oaths',$in);
			return; 
		}
		redirect("login");
		return;
	}
	 
	 
	 
	 
}


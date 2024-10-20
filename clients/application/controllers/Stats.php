<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats extends CI_Controller {
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
	
	public function status($code = "")
	{
		
		if(!empty($code))
		{
			$rec = $this->db->where('activation_code',$code)->get("customer");
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();
				$this->db->where('activation_code',$code)->update('customer',array('status'=>1));
				$this->session->set_userdata('sospawn_task_login',$data);
				redirect("home");
				return;	
			}
			
		}
		show_404();
	}
	public function logout()
	{
		$this->session->unset_userdata('sospawn_task_login');
		//$this->session->sess_destroy();
		header("location:../../../../");
	} 
	public function tier()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$id_tier = $this->input->post('id_tier',true);
			$rec = $this->db->where('id',$id_tier)->get("tier");
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();
				$data['fix_usdt'] = number_format($data['usdt'],0);
				$data['fix_presale_token'] = number_format($data['presale_token'],0);
				$data['fix_bonus'] = number_format($data['bonus'],0);
				
				json(array('error'=>false,'message'=>'error false',"data"=>$data,'security'=>token()));
				return;	
	
			}
			json(array('error'=>true,'message'=>'failed','security'=>token()));
			return;	
		}
		show_404();
	}
	//forgot
	public function forgot($code = "")
	{
		
		if(!empty($code))
		{
			$rec = $this->db->where('activation_code',$code)->get("customer");
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();
				$in['data'] = $data;
				$in['title'] = "Forgot";
				//$this->load->view('manager/forgot-entry',$in);
				$this->load->view('manager/auths/forgot-entry',$in);
				return;  
				 
			}
			
		}
		show_404();
	}
	 
}
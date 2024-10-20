<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Smart_Controller {

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
	public function save_wallet()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			
			 
			$this->db->trans_begin();
			$time = time();
			$this->db->where('id',user_info("id"));
			$old = $this->db->get('customer');
			if($old->num_rows()==1)
			{
					$arr = $old->row_array();
					 
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',user_info("id"));
					$this->db->update('customer',array("wallet_address"=>$in['wallet_address']));
			}
			else
			{
					echo json_encode(array('error'=>true,'message'=>'Data not found','security'=>token()));
					exit;
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
				$c = $this->db->where('id',user_info('id'))->get("customer")->row_array();
				$this->session->set_userdata('xomm_presale_login',$c);
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	} 
	 
	
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wd extends Smart_Controller {

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
	public function Check()
	{
		$in = $this->input->post(); 
		$post = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		if(isset($post['serialnumber']))
		{
			$check = $this->db->where('partner_reff',$post['partner_reff'])->get('withdraw');
			if($check->num_rows()>0)
			{
				$d = $check->row_array();
				$status = 2;
				if($post['status']=="SUCCESS")
				{
					$status = 1;
				}
				if($post['status']=="PENDING")
				{
					$status = 3;
				}
				$this->db->trans_begin();
				$this->db->where('id',$d['id'])->update('withdraw',array('wd_info'=>json_encode($post),'status'=>$status,'statuses'=>$post['status'])); 
				$this->db->trans_commit();	
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
		}else if(isset($in['serialnumber']))
		{
			$check = $this->db->where('partner_reff',$in['partner_reff'])->get('withdraw');
			if($check->num_rows()>0)
			{
				$d = $check->row_array();
				$status = 2;
				if($in['status']=="SUCCESS")
				{
					$status = 1;
				}
				if($in['status']=="PENDING")
				{
					$status = 3;
				}
				$this->db->trans_begin();
				$this->db->where('id',$d['id'])->update('withdraw',array('wd_info'=>json_encode($in),'status'=>$status,'statuses'=>$in['status'])); 
				$this->db->trans_commit();	
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
		}
		json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
		return;
		
		 
	}
	 
	
}


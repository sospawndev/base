<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_error extends CI_Controller {

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
	public function transfer()
	{
		 
		
		 
		$in['title'] = ""; 
		$in['tpl'] = "page_error/transfer";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function error_ip()
	{
		 
		
		 
		$in['title'] = ""; 
		$in['tpl'] = "page_error/error_ip";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function error_ip_check()
	{
		 
		
		 
		$in['title'] = ""; 
		$in['tpl'] = "page_error/error_ip_check";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function withdraw()
	{
		 
		
		 
		$in['title'] = ""; 
		$in['tpl'] = "page_error/withdraw";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function namas()
	{
		 
		
		 
		$in['title'] = ""; 
		$in['tpl'] = "page_error/namas";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function actived()
	{
		$in['title'] = ""; 
		$in['tpl'] = "page_error/actived";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function blockeds($id)
	{
		if(!empty($id))
		{ 
			$rec = $this->db->where('id',$id)->get('v_customer');
			if($rec->num_rows()==1)
			{
				$in['data'] = $rec->row_array();  
				$in['title'] = ""; 
				$in['tpl'] = "page_error/blocked";
				$this->load->view('manager/layout',$in);
				return; 
			}
		}
		redirect("login");
		return;
	}
	public function vpns()
	{
		 
		
		 
		$in['title'] = ""; 
		$in['tpl'] = "page_error/proxy";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function check_vpn()
	{
		 
		//$details = json_decode(file_get_contents("https://ipinfo.io/".getUserIP()."/json"));
		//print_r($details);
		//exit;
		if(check_proxy())
		{
			redirect('page-error/vpns');
			return;
		}
		check_2proxy();
	}
	 
	
}


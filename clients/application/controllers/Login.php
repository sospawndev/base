<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		// echo $this->encryption->decrypt('c03a2fda5f7d2c41cb0930053b02b50ed6d82a922d10b0db0d7f08dcdb58cf6d017dc51eb5622b913aefb952627d6e752c15667785cd59e6abc1c0ffa05abcdc87Vy7+MrxxUyxjNC/eltd0KjU9PdRIiPryKFhm6O07U=');
		// exit;
		$in['title'] = "Logins";
		//$this->load->view('manager/login',$in);
		$this->load->view('manager/auths/login',$in);
		return; 
	}
	public function check()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$email = $this->input->post('email',true);
			$pass = $this->input->post('password',true);
			$this->db
			->where("status=1")
			->where("type=1") 
			->where("( email = '".$email."')");
			$arr =  $this->db->get('customer')->result_array();
			
			for($i=0;$i<count($arr);$i++)
			{
				 
				 $arr[$i]['passwords'] = $this->encryption->decrypt($arr[$i]['passwords']);
                 if($arr[$i]['passwords']==$pass)
                 {
					$c = $arr[$i];
					 
					$this->session->set_userdata('sospawn_task_login',$c);
					json(array('error'=>false,'message'=>'Proses User','security'=>token(),'data'=>$arr[$i]));
					return;
				}
			}
			json(array('error'=>true,'message'=>'User not found','security'=>token()));
			return;	
		}
		show_404();
	}
	public function logout()
	{
		$this->session->unset_userdata('sospawn_task_login');
		//$this->session->sess_destroy();
		redirect('login');
	}
	public function forgot()
	{
		//echo $this->encryption->encrypt('seller');
		//exit;
		$in['title'] = "Logins";
		//$this->load->view('manager/forgot',$in);
		$this->load->view('manager/auths/forgot',$in);
		return; 
	}
	public function token()
	{
		json(array('error'=>false,'message'=>'token generate','security'=>token()));
		return;
	}
	 
	 
}


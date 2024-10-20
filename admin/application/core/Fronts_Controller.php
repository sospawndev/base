<?php
class Smart_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->encryption->initialize(array('driver' => 'openssl'));
		
		$this->checkauth();
		
	}
	private  function checkauth()
	{
		$ses = $this->session->userdata('adminmeong_login');
		 
		 
		//insert_fcm();
		$class = $this->router->fetch_class();
		if($class=='login' && !empty($ses))
		{
			redirect('home');
			return;
		}
		if(empty($ses))
		{
			//$this->session->sess_destroy();
			$this->session->unset_userdata('adminmeong_login');
			redirect('login');
			return;
		}
	}
}